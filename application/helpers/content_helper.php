<?php

if ( ! function_exists('trim_unique_filename')) {
	function trim_unique_filename($file_name) {
		// Remove path information and dots around the filename, to prevent uploading
	    // into different directories or replacing hidden system files.
	    // Also remove control characters and spaces (\x00..\x20) around the filename:
	    $file_name = trim(basename(stripslashes($file_name)), ".\x00..\x20");

	    //Ensure that we don't have disallowed characters and add a unique id just to ensure that the file name will be unique
	    $file_name = substr(uniqid(),-5).'-'._transliterate_chars($file_name);

		//all the characters has to be lowercase
	    $file_name = strtolower($file_name);

	    return $file_name;    
	}
}

if ( ! function_exists('_transliterate_chars'))
{
	function _transliterate_chars($file_name) {
		$translit_characters = array(

			// Aa
			'/Α|Ά|А|À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
			'/α|ά|а|à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',

			// Bb
			'/Β|Б/' => 'B',
			'/β|б/' => 'b',

			// Cc
			'/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
			'/ç|ć|ĉ|ċ|č/' => 'c',

			// Dd
			'/Δ|Д|Ð|Ď|Đ/' => 'D',
			'/δ|д|ð|ď|đ/' => 'd',

			// Ee
			'/Ε|Έ|Е|Э|Є|È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
			'/ε|έ|е|э|є|è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',

			// Ff
			'/Φ|Ф/' => 'F',
			'/φ|ф|ƒ/' => 'f',

			// Gg
			'/Γ|Г|Ĝ|Ğ|Ġ|Ģ/' => 'G',
			'/γ|г|ĝ|ğ|ġ|ģ/' => 'g',

			// Hh
			'/Х|Ĥ|Ħ/' => 'H',
			'/х|ĥ|ħ/' => 'h',

			// Ii
			'/Η|Ή|Ι|Ί|И|Ы|І|Ї|Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
			'/η|ή|ι|ί|и|ы|і|ї|ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',

			// Jj
			'/Ĵ/' => 'J',
			'/ĵ/' => 'j',

			// Kk
			'/Κ|К|Ķ/' => 'K',
			'/κ|к|ķ/' => 'k',

			// Ll
			'/Λ|Л|Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
			'/λ|л|ĺ|ļ|ľ|ŀ|ł/' => 'l',

			// Mm
			'/Μ|М/' => 'M',
			'/μ|м/' => 'm',

			// Nn
			'/Ν|Н|Ñ|Ń|Ņ|Ň/' => 'N',
			'/ν|н|ñ|ń|ņ|ň|ŉ/' => 'n',

			// Oo
			'/Ο|Ό|О|Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
			'/ο|ό|о|ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',

			// Pp
			'/Π|П/' => 'P',
			'/π|п/' => 'p',

			// Qq
			// '//' => 'Q',
			// '//' => 'q',

			// Rr
			'/Ρ|Р|Ŕ|Ŗ|Ř/' => 'R',
			'/ρ|р|ŕ|ŗ|ř/' => 'r',

			// Ss
			'/Σ|С|Ś|Ŝ|Ş|Š/' => 'S',
			'/σ|ς|с|ś|ŝ|ş|š|ſ/' => 's',

			// Tt
			'/Τ|Т|Ţ|Ť|Ŧ/' => 'T',
			'/τ|т|ţ|ť|ŧ/' => 't',

			// Uu
			'/У|Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
			'/у|ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',

			// Vv
			'/В/' => 'V',
			'/в/' => 'v',

			// Ww
			'/Ω|Ώ|Ŵ/' => 'W',
			'/ω|ώ|ŵ/' => 'w',

			// Xx
			'/Χ/' => 'X',
			'/χ/' => 'x',

			// Yy
			'/Υ|Ύ|Ψ|Й|Ý|Ÿ|Ŷ/' => 'Y',
			'/υ|ύ|ψ|й|ý|ÿ|ŷ/' => 'y',

			// Zz
			'/Ζ|З|Ź|Ż|Ž/' => 'Z',
			'/ζ|з|ź|ż|ž/' => 'z',

			'/Θ/' => 'Th',
			'/θ/' => 'th',

			'/Ξ/' => 'Ks',
			'/ξ/' => 'ks',

			'/Ё/' => 'Yo',
			'/ё/' => 'yo',

			'/Ж/' => 'Zh',
			'/ж/' => 'zh',

			'/Ц/' => 'Ts',
			'/ц/' => 'ts',

			'/Ч/' => 'Ch',
			'/ч/' => 'ch',

			'/Ш/' => 'Sh',
			'/ш/' => 'sh',

			'/Щ/' => 'Sch',
			'/щ/' => 'sch',

			'/Ь|Ъ/' => '',
			'/ь|ъ/' => '',

			'/Ю/' => 'Yu',
			'/ю/' => 'yu',

			'/Я/' => 'Ya',
			'/я/' => 'ya',

			'/Æ|Ǽ/' => 'AE',
			'/Ä/' => 'Ae',
			'/ä|æ|ǽ/' => 'ae',

			'/Œ/' => 'OE',
			'/Ö/' => 'Oe',
			'/ö|œ/' => 'oe',

			'/Ü/' => 'Ue',
			'/ü/' => 'ue',

			'/Ĳ/' => 'IJ',
			'/ĳ/' => 'ij',

			'/ß/'=> 'ss',

		);
		$file_name = preg_replace(array_keys($translit_characters), array_values($translit_characters), $file_name);

		$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '-', $file_name);
		$file_name = str_replace(" ", "-", $file_name);

		return preg_replace('/\-+/', '-', trim($file_name, '-'));
	}
}