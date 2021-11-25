<?php
	/**
	*Build the form for movies in the Discover+ page
	*/
	function movie_genres_form(): string{
		$str="";
		$file_content = "https://api.themoviedb.org/3/genre/movie/list?api_key=6fbe81640652c3e4addc8e22eff8655d&language=fr";
		$movie_list_json = file_get_contents($file_content);
		$genre_movie_list = json_decode($movie_list_json);
		$str.= "\t<table>\n";
		$str.= "\t\t<tr>\n";
		$lines=0;
		$num_genre=0;
		foreach ($genre_movie_list->genres as $movie_genre) {
			$str.="\t\t\t<td><input type=\"checkbox\" name=\"genre".$num_genre."\" value=\"".$movie_genre->id."\" />".str_replace('&', '&amp;', $movie_genre->name)."</td>\n";
			$num_genre++;
			$lines++;
			if ($lines==4) {
				$str.= "\t\t</tr>\n";
				$str.= "\t\t<tr>\n";
			$lines = 0;
			}
		}
		$str.= "\t\t</tr>\n";
		$str.= "\t</table>\n";
		return $str;
	}

	/**
	*Build the form for series in the Discover+ page
	*/
	function tv_genres_form(): string{
		$str="";
		$file_content = "https://api.themoviedb.org/3/genre/tv/list?api_key=6fbe81640652c3e4addc8e22eff8655d&language=fr";
		$tv_list_json = file_get_contents($file_content);
		$genre_tv_list = json_decode($tv_list_json);
		$str.= "\t<table>\n";
		$str.= "\t\t<tr>\n";
		$lines=0;
		$num_genre=0;
		foreach ($genre_tv_list->genres as $tv_genre) {
			$str.="\t\t\t<td><input type=\"checkbox\" name=\"genre".$num_genre."\" value=\"".$tv_genre->id."\" />".str_replace('&', '&amp;', $tv_genre->name)."</td>\n";
			$num_genre++;
			$lines++;
			if ($lines==4) {
				$str.= "\t\t</tr>\n";
				$str.= "\t\t<tr>\n";
			$lines = 0;
			}
		}
		$str.= "\t\t</tr>\n";
		$str.= "\t</table>\n";
		return $str;
	}

	/**
	*A simple redirection function, to use in case of errors
	*/
	function redirection(string $redirection_url): string{
		return "<meta http-equiv=\"refresh\" content=\"0 ;URL=".$redirection_url."\">";
	}

	/**
	*Get the HTML information of Geopluggin
	*@return a HTML well formed treatment of XML informations.
	*/
	function get_xml_info():string{
		$url = "http://www.geoplugin.net/xml.gp?ip=".$_SERVER['REMOTE_ADDR'];
		$xml = simplexml_load_file($url);
		$str="<p><strong>Adresse IP : </strong>".$xml->geoplugin_request."</p>";
		$str.="<p><strong>Localisation : </strong>".$xml->geoplugin_city.", ".$xml->geoplugin_region." (".$xml->geoplugin_countryName.") </p>";
		$str.="<p>Données par :<a href=\"https://www.geoplugin.com/webservices/xml\">Geoplugin</a></p>";
		return $str;
	}
?>