<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configuration
 *
 * @author thibault
 */
require APPPATH . 'modules/blog/models/Blogpost.php';

class Tutorial extends Blogpost {

	const TABLE_NAME = 'posts_blog_tutorial';

	public function getTableName() {
		return self::TABLE_NAME;
	}

	public function beforeInsert(&$to_insert = null) {
		$this->doHtmlParsing($to_insert);
		parent::beforeInsert($to_insert);
	}

	public function afterInsert($insert_id, &$to_insert = null) {
		$this->doKeyWordLinking($to_insert, $insert_id);
		parent::afterInsert($insert_id, $to_insert);
	}

	public function validationRulesForInsert($datas) {
		$rules = parent::validationRulesForInsert($datas);
		foreach ($rules as &$rule) {
			foreach (array('content', 'description') as $f) {
				if (isset($rule['field']) && $rule['field'] == $f) {
					$rule['field'] = $f . '_bb';
					break;
				}
			}
		}
		$rules[] = array(
			'field' => 'keys',
			'label' => 'Mots-clé',
			'rules' => 'required|min_length[2]|max_length[250]'
		);
		return $rules;
	}

	public function validationRulesForUpdate($datas) {
		$rules = parent::validationRulesForUpdate($datas);
		foreach ($rules as &$rule) {
			foreach (array('content', 'description') as $f) {
				if (isset($rule['field']) && $rule['field'] == $f) {
					$rule['field'] = $f . '_bb';
					break;
				}
			}
		}
		$rules[] = array(
			'field' => 'keys',
			'label' => 'Mots-clé',
			'rules' => 'min_length[2]|max_length[250]'
		);
		return $rules;
	}

	public function beforeUpdate(&$datas = null, $where = null) {
		$this->doHtmlParsing($datas);
		parent::beforeUpdate($datas, $where);
	}

	public function afterUpdate(&$datas = null, $where = null) {
		if (isset($where[$this->db->dbprefix($this->getTableName()) . '.id'])) {
			$this->doKeyWordLinking($datas, $where[$this->db->dbprefix($this->getTableName()) . '.id']);
		}
		parent::afterUpdate($datas, $where);
	}

	public function doHtmlParsing(&$datas) {
		$this->load->library('BBCodeParser', null, 'bbparser');
		foreach (array('content', 'description') as $el) {
			if (isset($datas[$el . '_bb'])) {
				$elContent = $datas[$el . '_bb'];
				$this->bbparser->parse($elContent);
				$datas[$el] = $this->bbparser->getAsHtml();
			}
		}
	}

	public function doKeyWordLinking($datas, $idTutorial) {

		if (!isset($datas['keys']))
			return;

		$keys = $datas['keys'];

		$keysArray = explode(' ', $keys);

		$this->load->model('linktutorialhashtag');
		$this->load->model('hashtag');

		$this->linktutorialhashtag->delete(array('tutorial_id' => $idTutorial));

		foreach ($keysArray as $key) {
			$key = alias($key);
			$idKey = $this->hashtag->insert(array('content' => $key));
			$this->linktutorialhashtag->link($idTutorial, $idKey);
		}
	}

	public function keySearch($limit = null, $offset = null, $search = null, $userId = null) {
		if ($limit !== null) {
			$this->db->limit($offset, $limit);
		}

		if (!$search) {
			$search = $this->getData('search');
		}

		$this->load->model('linktutorialhashtag');
		$this->load->model('hashtag');
		$this->load->model('memberspace/user');
		$this->join(Linktutorialhashtag::$TABLE_NAME, $this->db->dbprefix(Linktutorialhashtag::$TABLE_NAME) . '.tutorial_id=' . $this->db->dbprefix(self::TABLE_NAME) . '.id', 'right');
		$this->join(Hashtag::TABLE_NAME, $this->db->dbprefix(Hashtag::TABLE_NAME) . '.id=' . $this->db->dbprefix(Linktutorialhashtag::$TABLE_NAME) . '.hashtag_id', 'left');
		$this->join(User::$TABLE_NAME, User::$TABLE_NAME . '.id = ' . $this->db->dbprefix(Post::$TABLE_NAME) . '.user_id', 'left');
		$this->db->select('count(*) as matchings');
		$this->db->select('login as author');
		$table_hash = Hashtag::TABLE_NAME;
		if (is_string($search))
			$this->db->where("$table_hash.content", $search);
		else if (is_array($search))
			$this->db->where_in("$table_hash.content", $search);
//		$this->db->where($this->db->escape($search)." LIKE CONCAT('%',$table_hash.content,'%')");
		$this->db->order_by('matchings DESC');
		$this->db->group_by(self::TABLE_NAME . '.id');
		$userId = ($userId) ? $userId : user_id();
		$this->db->where(array('user_id' => $userId));
		return $this->get();
	}

	public function getOwn($limit = null, $offset = null, $userId = null) {
		$this->join(User::$TABLE_NAME, User::$TABLE_NAME . '.id = ' . $this->db->dbprefix(Post::$TABLE_NAME) . '.user_id', 'left');
		$this->db->select('login as author');
		$userId = ($userId) ? $userId : user_id();
		$this->db->where(array('user_id' => $userId));
		if ($limit !== null) {
			$this->db->limit($offset, $limit);
		}
		return $this->get();
	}

}
?>

