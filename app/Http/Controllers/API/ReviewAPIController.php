<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewAPIController extends Controller
{
    public function getReviews(Request $request, $item_id)
    {
        $reviews = \App\Models\Review::where('item_id', $item_id)->get();
        $total_reviews = $reviews->count();
        $total_rating = 0;
        foreach ($reviews as $review) {
            $total_rating += $review->rating;
        }
        
        if($total_reviews > 0){
            $average_rating = $total_rating / $total_reviews;
        }else{
            $average_rating = 0;
        }

        $latestReview = Review::where('item_id', $item_id)->orderBy('created_at', 'desc')->take(5)->get();
        $latestReviewList = [];
        foreach($latestReview as $review_item){
            array_push($latestReviewList,[
                'user_name' => $review_item->User->name,
                'item_id' => $review_item->item_id,
                'review' => $review_item->review,
                'rating' => $review_item->rating,
                'created_at' => $review_item->created_at,
            ]);
        }
        $response = [
          
            'total_reviews' => $total_reviews,
            'average_rating' => $average_rating,
            'latest_review' => $latestReviewList,
        ];
        return response()->json($response,200);
    }

    public function addReview(Request $request){
        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->item_id = $request->item_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return response()->json(['message' => 'Review added successfully'],200);
    }

    public function checkUserReview(Request $request, $item_id){
        $review = Review::where('user_id', auth()->user()->id)->where('item_id', $item_id)->first();
        if($review){
            return response()->json(['message' => 'Review found', 'review' => $review],200);
        }else{
            return response()->json(['message' => 'Review not found'],404);
        }
    }

    public function updateUserReview(Request $request){
        $review = Review::where('user_id', auth()->user()->id)->where('item_id', $request->item_id)->first();
        if($review){
            $review->review = $request->review;
            $review->rating = $request->rating;
            $review->save();
            return response()->json(['message' => 'Review updated successfully'],200);
        }else{
            return response()->json(['message' => 'Review not found'],404);
        }
    }

    public function getUserReviews(Request $request){
        $reviews = Review::where('user_id', auth()->user()->id)->get();
        $review_list = [];
        foreach($reviews as $review){
            array_push($review_list,[
                'id' => $review->id,
                'item_id' => $review->item_id,
                'item_name' => $review->Item->item_name,
                'item_image' => asset('images/items/'.$review->Item->item_image),
                'review' => $review->review,
                'rating' => $review->rating,
                'created_at' => $review->created_at->format('d M Y'),
            ]);
        }
        return response()->json($review_list,200);
    }

    public function deleteReview(Request $request){
        $review = Review::where('user_id', auth()->user()->id)->where('id', $request->id)->first();
        if($review){
            $review->delete();
            return response()->json(['message' => 'Review deleted successfully'],200);
        }else{
            return response()->json(['message' => 'Review not found'],404);
        }
    }

    public function getAllReviews($item_id){
        $reviews = Review::where('item_id', $item_id)->get();
        $review_list = [];
        foreach($reviews as $review){
            array_push($review_list,[
                'id' => $review->id,
                'user' => $review->User->name,
                'review' => $review->review,
                'rating' => $review->rating,
                'created_at' => $review->created_at->format('d M Y'),
            ]);
        }
        return response($review_list,200);
    }
}
