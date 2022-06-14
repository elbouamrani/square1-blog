<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\PostRequest;
use App\Models\User;

use Exception;

class FeedImportService 
{
    public function import()
    {
        $user = $this->getImportUser();
        $data = $this->queryFeedPosts();

        $validated = array_map(function($item) {
            return $this->validatePost($item);
        }, $data);

        $postsCount = count($user->posts()->createMany($validated));
    
        return $postsCount;
    }

    public function generateFeedUser()
    {
        $importUserId = $this->getImportUserId();

        $exists = User::find($importUserId);

        if($exists) {
            throw new Exception('FeedUserIdUnvalid');
        }

        $user = new User();

        $user->id = $importUserId;
        $user->name = config('feed.user_name');
        $user->email = '*';
        $user->password = '*';

        $user->save();

        return $user;
    }

    private function getFeedEndpoint()
    {
        $endpoint = config('feed.endpoint');
        
        if(!$endpoint) {
            throw new Exception('FeedEndpointNotFound');
        }

        return $endpoint;   
    }

    public function getImportUserId()
    {
        $importUserId = config('feed.user_id');
        
        if(!$importUserId) {
            throw new Exception('FeedUserIdNotFound');
        }

        return $importUserId;
    }

    private function getImportUser()
    {
        $importUserId = $this->getImportUserId();
        $user = User::find($importUserId);

        if(!$user) {
            throw new Exception('SystemUserNotFound');
        }

        return $user;
    }

    private function queryFeedPosts()
    {
        $response = Http::get($this->getFeedEndpoint());

        if($response->failed()){
            throw new Exception('FeedEndpointNotReachable');
        }

        return $response->json()['data'];
    }

    private function getPostValidationRules()
    {
        return PostRequest::getRules();
    }

    private function validatePost(Array $data)
    {
        $rules = $this->getPostValidationRules();
        $validator = Validator::make($data, $rules);

        if($validator->fails())
        {
            throw new Exception('FeedPostUnvalid');
        }

        return $validator->validated();
    }
}