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
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryGroupFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGroup whereUpdatedAt($value)
 */
	class CategoryGroup extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $thumbnail
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 */
	class Brand extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property int|null $category_group_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category selectable()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $invoice_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $user_id
 * @property string $total_price
 * @property string $delivery_charge
 * @property int $delivery_district_id
 * @property int $delivery_city_id
 * @property string $delivery_address
 * @property string $payment_method
 * @property \App\Enums\PaymentStatus $payment_status
 * @property string|null $transaction_id
 * @property string|null $coupon_id
 * @property string|null $currency_code
 * @property string|null $notes
 * @property \App\Enums\OrderStatus $status
 * @property string|null $payment_approve_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\OrderCity $deliveryCity
 * @property-read \App\Models\Shop\OrderDistrict $deliveryDistrict
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\User $owner
 * @method static \Database\Factories\Shop\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentApproveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $delivery_charge
 * @property int $order_district_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\OrderDistrict $OrderDistrict
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereDeliveryCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereOrderDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCity whereUpdatedAt($value)
 */
	class OrderCity extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\OrderCity> $orderCities
 * @property-read int|null $order_cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDistrict whereUpdatedAt($value)
 */
	class OrderDistrict extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property float $unit_price
 * @property int $qty
 * @property array|null $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\Order $order
 * @property-read \App\Models\Shop\Product $product
 * @method static \Database\Factories\Shop\OrderItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $thumbnail
 * @property int $user_id
 * @property int|null $brand_id
 * @property int $qty
 * @property string $sku
 * @property string $description
 * @property float $cost
 * @property float $price
 * @property float|null $discounted_price
 * @property int $is_active
 * @property int $is_approved
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\ProductImage> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Shop\ProductLongDescription|null $longDescription
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\ProductVariant> $variants
 * @property-read int|null $variants_count
 * @method static \Database\Factories\Shop\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\Product $product
 * @method static \Database\Factories\Shop\ProductImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereUpdatedAt($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\Product $product
 * @method static \Database\Factories\Shop\ProductLongDescriptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLongDescription whereUpdatedAt($value)
 */
	class ProductLongDescription extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shop\ProductVariantAttribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \App\Models\Shop\Product $product
 * @method static \Database\Factories\Shop\ProductVariantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereUpdatedAt($value)
 */
	class ProductVariant extends \Eloquent {}
}

namespace App\Models\Shop{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $product_variant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop\ProductVariant|null $variant
 * @method static \Database\Factories\Shop\ProductVariantAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute whereProductVariantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariantAttribute whereUpdatedAt($value)
 */
	class ProductVariantAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $phone
 * @property string|null $color
 * @property string $price
 * @property string|null $thumbnail
 * @property string $description
 * @property \App\Enums\DeliveryStatus $status
 * @property int $is_published
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereUpdatedAt($value)
 */
	class Test extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string $role
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

