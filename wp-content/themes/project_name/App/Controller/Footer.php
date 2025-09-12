<?php

namespace App\Controller;

use App\Acf\Acf;

final class Footer implements Item {

	public static function getFields(): array {
		if(!Acf::isAcfPluginActivated()) {
			return [];
		}

		return [
			'socials_logo' => get_field('general_social_logo', 'option'),
			'socials_link' => get_field('general_social_link', 'option'),
			'login_button_text' => get_field('general_login_button_text', 'option'),
		];
	}
}