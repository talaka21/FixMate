<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property array<array-key, mixed> $description
 * @property string|null $thumbnail
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $thumbnail_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProviderRequest> $serviceProviderRequests
 * @property-read int|null $service_provider_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProvider> $serviceProviders
 * @property-read int|null $service_providers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subcategory> $subcategories
 * @property-read int|null $subcategories_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property array<array-key, mixed> $description
 * @property string|null $image
 * @property string $phone
 * @property string|null $website
 * @property int $state_id
 * @property int $city_id
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\city $city
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\state $state
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GovernmentEntity whereWebsite($value)
 */
	class GovernmentEntity extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language query()
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $message
 * @property \App\Enum\NotificationEnum|null $target_type
 * @property int|null $target_id
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $send_at
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdByUser
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $target
 * @property-read \App\Models\User|null $targetUser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTargetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $service_provider_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $expire_date
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ServiceProvider $serviceProvider
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereServiceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Offer whereUpdatedAt($value)
 */
	class Offer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $phone_number
 * @property string $token
 * @property string|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PhonePasswordReset whereToken($value)
 */
	class PhonePasswordReset extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $provider_name
 * @property string|null $shop_name
 * @property array<array-key, mixed>|null $description
 * @property string|null $phone
 * @property string|null $whatsapp
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $image
 * @property array<array-key, mixed>|null $gallery
 * @property string|null $contract_start
 * @property string|null $contract_end
 * @property \App\Enum\ServiceProviderEnum $status
 * @property int $views
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $state_id
 * @property int $city_id
 * @property string|null $tag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\city $city
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Offer> $offers
 * @property-read int|null $offers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Slider> $sliders
 * @property-read int|null $sliders_count
 * @property-read \App\Models\state $state
 * @property-read \App\Models\Subcategory $subcategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereContractEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereContractStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProvider whereWhatsapp($value)
 */
	class ServiceProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $provider_name
 * @property string|null $shop_name
 * @property string|null $description
 * @property string|null $phone
 * @property string|null $whatsapp
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $image
 * @property \App\Enum\statusServiceProviderRequestEnum $status
 * @property string $is_read
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $state_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\city $city
 * @property-read \App\Models\state $state
 * @property-read \App\Models\Subcategory $subcategory
 * @method static \Database\Factories\ServiceProviderRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceProviderRequest whereWhatsapp($value)
 */
	class ServiceProviderRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string $image
 * @property int $service_provider_id
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\ServiceProvider $serviceProvider
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereServiceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property array<array-key, mixed> $description
 * @property string|null $thumbnail
 * @property \App\Enum\stateStatusEnum $status
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read mixed $thumbnail_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProviderRequest> $serviceProviderRequests
 * @property-read int|null $service_provider_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProvider> $serviceProviders
 * @property-read int|null $service_providers_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subcategory whereUpdatedAt($value)
 */
	class Subcategory extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProvider> $serviceProviders
 * @property-read int|null $service_providers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $email
 * @property string|null $image
 * @property int $state_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property \App\Enum\UserEnum $status
 * @property string|null $verify_code
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\city $city
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\ServiceProviderRequest|null $serviceProviderRequest
 * @property-read \App\Models\state $state
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereVerifyCode($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property int $state_id
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GovernmentEntity> $governmentEntities
 * @property-read int|null $government_entities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProviderRequest> $serviceProviderRequests
 * @property-read int|null $service_provider_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProvider> $serviceProviders
 * @property-read int|null $service_providers_count
 * @property-read \App\Models\state $state
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|city whereUpdatedAt($value)
 */
	class city extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $phone_number
 * @property string $token
 * @property string|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|password_resets whereToken($value)
 */
	class password_resets extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property \App\Enum\stateStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\city> $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GovernmentEntity> $governmentEntities
 * @property-read int|null $government_entities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProviderRequest> $serviceProviderRequests
 * @property-read int|null $service_provider_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceProvider> $serviceProviders
 * @property-read int|null $service_providers_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|state whereUpdatedAt($value)
 */
	class state extends \Eloquent {}
}

