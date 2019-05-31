<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Http\Controllers\Controller;

// Models
use App\Models\{
    Client,
    Tariff
};

// Res
use App\Http\Resources\{TariffResource, ClientResource};

// Req
use App\Http\Requests\ConfirmRequest;

class ActionController extends Controller
{
    public function getTariffs()
    {
        return TariffResource::collection(Tariff::all());
    }

    public function getStatistics()
    {
        $clients = Client::with([
            'orders' => function (HasMany $query) {
                $query->latest();
        }, 'orders.tariff'])->get();

        return ClientResource::collection($clients);
    }
    
    public function confirm(ConfirmRequest $request)
    {
        $data = $request->toArray();

        try {

            $order = DB::transaction(function () use ($data) {

                $client = Client::updateOrCreate(
                    [
                        'phone' => $data['phone'],
                    ],
                    [
                        'name'  => $data['name'],
                        'phone' => $data['phone'],
                    ]
                );

                return $client->orders()->create([
                    'tariff_id'   => $data['tariff_id'],
                    'name'        => $data['name'],
                    'address'     => $data['address'],
                    'amount_days' => $data['amount_days'],
                ]);
            });

        } catch (\Throwable $e) {

            Log::driver('orders')->debug($data);
            Log::driver('orders')->debug($e);

            return response()->json(['message' => 'Произошла ошибка. Повторите попытку через некоторе время.'], 500);
        }

        return response()->json([
            'message' => 'Заказ №' . $order->id . ' успешно создан!',
        ]);
    }
}
