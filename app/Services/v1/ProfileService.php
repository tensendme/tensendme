<?php


namespace App\Services\v1;


interface ProfileService
{
    public function updateProfile($profile);
    public function changeAvatar($avatar);
    public function myProfile();
}
