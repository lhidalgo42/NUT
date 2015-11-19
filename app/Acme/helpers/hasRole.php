<?php
 namespace Acme\helpers;

 class hasRole{
     public static function Secretaria(){
         $user = \Auth::user();
         if(\Role::find($user->roles_id)->name == "Secretaria")
             return true;
         return false;
     }
     public static function Administrador(){
         $user = \Auth::user();
         if(\Role::find($user->roles_id)->name == "Administrador")
             return true;
         return false;
     }
     public static function Therapist(){
         $user = \Auth::user();
         if(\Role::find($user->roles_id)->name == "Terapeuta")
             return true;
         return false;
     }


 }