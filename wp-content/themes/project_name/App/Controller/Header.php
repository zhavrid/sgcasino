<?php

namespace App\Controller;

use App\Acf\Acf;

final class Header implements Item {

	public static function getFields(): array {

		if(!Acf::isAcfPluginActivated()) {
			return [];
		}

		return [
			'logo' => get_field('header_header_logo', 'option'),
			'socials_logo' => get_field('general_social_logo', 'option'),
			'socials_link' => get_field('general_social_link', 'option'),
			'login_button_text' => get_field('general_login_button_text', 'option'),
		];
	}
}