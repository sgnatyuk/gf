<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tariff
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tariff whereUpdatedAt($value)
 */
	class Tariff extends \Eloquent {}
}

