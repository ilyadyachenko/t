<?php
\DB::connection()->enableQueryLog();

$all_offers = Offer::params()->get();

$queries = \DB::getQueryLog();

$sql = logger($queries);
protected static function logger($queries) 
{
			$formattedQueries = [];
			foreach( $queries as $query ) :
				$prep = $query['query'];
				foreach( $query['bindings'] as $binding ) :
					$prep = preg_replace("#\?#", is_numeric($binding) ? $binding : "'" . $binding . "'", $prep, 1);
				endforeach;
				$formattedQueries[] = $prep;
			endforeach;
			return $formattedQueries;
		}
