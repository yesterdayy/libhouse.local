<?php

namespace App\Models\SiteReview;

use Illuminate\Database\Eloquent\Model;

class SiteReview extends Model
{

    protected $table = "site_reviews";

    public static function getReviews($limit = 3) {
        return SiteReview::join('site_reviews_source', 'site_reviews_source.id', '=', 'site_reviews.customer_source_id')->orderBy('site_reviews.id', 'DESC')->limit($limit)->getQuery()->get();
    }

}
