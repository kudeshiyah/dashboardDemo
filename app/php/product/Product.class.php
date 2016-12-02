<?php

class Product
{
	private $conn;
	private $products;

	function __construct($conn)
	{
		$this->conn = $conn;
		$this->products = $this->conn->products;
	}


	public function get_all()
	{
		$documents = [];
		$cursor = $this->products->find();
		foreach ($cursor as $doc) {
			array_push($documents, $doc);
		}
		Result::success($documents);
	}

	public function get_one($post)
	{
		if($this->exist($post['pId'])){
			$doc = $this->products->findOne(array('pId'=>$post['pId']));
			unset($doc['_id']);
			Result::success($doc);
		}
	}

	public function create($post)
	{
		if (!$this->products->count(array('pId'=>$post['pId'])))
		{
				if(isset($post['imageName'])){
					if ($post['imageName']) {
						$image = $post['imageName'];
						$post['pImage'] = $image;
						unset($post['imageName']);
					}
				}
				$this->products->insert($post);
				Result::success([], "Product created Successfully");
		}
		else{
			Result::error("Product id should be unique");
		}
	}

	public function destroy($post)
	{
		if($this->exist($post['pId'])){
				$this->products->remove(array('pId'=>$post['pId']));
				Result::success([], "Product Deleted");
		}
	}

	public function update($post)
	{
		if($this->exist($post['pId'])){
			unset($post['_id']);
			$this->products->update(
				array('pId'=>$post['pId']),
				array('$set' => $post)
			);
			Result::success([], "Product Updated Successfully");
		}
	}

	private function exist($id)
	{
		if ($this->products->count(array('pId'=>$id))) {
			return true;
		}
		else {
			return false;
			Result::error("Product not found");
		}
	}

}

?>
