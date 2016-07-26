<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author thibault
 */
class Linktutorialhashtag extends DATA_Model {
	
	public static $TABLE_NAME = 'links_tutorials_hashtags';
	
	public static $PRIMARY_COLUMNS = array('tutorial_id','hashtag_id');

	public function getTableName() {
		return self::$TABLE_NAME;
	}
	
	public function getPrimaryColumns() {
		return self::$PRIMARY_COLUMNS;
	}
	
	public function link($tutorialId, $hashtagId){
		$link = $this->getRow(array('tutorial_id'=>$tutorialId,'hashtag_id'=>$hashtagId));
		if(!$link) {
			$this->insert(array('tutorial_id'=>$tutorialId,'hashtag_id'=>$hashtagId));
		}
	}

}

