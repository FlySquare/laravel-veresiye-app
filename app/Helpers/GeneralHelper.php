<?php

namespace App\Helpers;


class GeneralHelper{

    static function numberFormat($number)
    {
        return number_format($number, 2, ',', '.');
    }
    static function getMenu()
    {
        $request = \request();
        $menu = [];
        $menu[] = [
            'icon' => 'nav-icon fa fa-home',
            'title' => 'Home',
            'link' => route('index'),
            'route' => 'company_user.index',
            'badgeText' => '',
            'badgeClass' => '',
            'subMenus' => []
        ];
        $menu[] = [
            'icon' => 'nav-icon fa fa-users',
            'title' => 'Müşterilerim',
            'link' => route('customers.index'),
            'route' => 'company_user.index',
            'badgeText' => '',
            'badgeClass' => '',
            'subMenus' => []
        ];
        /*if (\Str::startsWith($request->route()->getName(), 'company_user.')) {
            $menu[] = [
                'icon' => 'nav-icon fa fa-font',
                'title' => \CTranslator::convert('My Instructions'),
                'link' => GeneralHelper::getLoggedRoute('my_event.instructions'),
                'route' => 'company_user.my_event.instructions',
                'badgeText' => '',
                'badgeClass' => '',
                'subMenus' => []
            ];

        }*/

        $menu[] = [
            'icon' => 'nav-icon fa fa-sign-out-alt',
            'title' => 'Çıkış Yap',
            'link' => route('logout'),
            'route' => 'admin.logout',
            'badgeText' => '',
            'badgeClass' => 'logoutMenu',
            'subMenus' => []
        ];
        return (object)$menu;
    }

    static function getRoles(): array
    {
        return [
            'admin',
            'seller',
            'only_mail'
        ];
    }

    static function getLanguages()
    {
        return [
            'en' => [
                'name' => 'English',
                'locale' => 'en',
                'flag' => asset('dist/img/flags/en.png')
            ],
            'de' => [
                'name' => 'Deutsch',
                'locale' => 'de',
                'flag' => asset('dist/img/flags/de.png')
            ],
            'tr' => [
                'name' => 'Türkçe',
                'locale' => 'tr',
                'flag' => asset('dist/img/flags/tr.png')
            ],
        ];
    }
    static function getLogged()
    {
        $userRepository = new \App\Repositories\UserRepository();
        return $userRepository->isLoggedIn() ? $userRepository->getLoggedUser() : null;
    }
    static function getCurrentLanguage()
    {
        return GeneralHelper::getLanguages()[session()->get('locale')] ?? GeneralHelper::getLanguages()['en'];
    }
}
