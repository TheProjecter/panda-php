<?php

class BlogController extends Controller {
	
	protected $models = array('Post');
	
	public function index() {
		$this->View->set('posts', $this->Post->find());
	}
	
	public function view($id = null) {
		$this->View->set('post', $this->Post->read($id, 'title,content'));
	}
	
	public function add() {
		$this->Post->save(array(
			'title' => 'Test',
			'content' => 'This is some awesome stufffs'
		));
	}
	
	public function edit($id = null) {
		$this->Post->save(array(
			'id' => 12,
			'title' => 'Test',
			'content' => 'This is some awesome stufffs'
		));
	}
	
	public function delete($id = null) {
		$this->Post->delete($id);
	}
	
}

?>