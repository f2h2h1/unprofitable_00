<?php
namespace GPojectPHP\Controllers;

use \GPojectPHP\Container as Container;
use \GPojectPHP\Models\Product;

class Home extends Main
{
	public function index() : string
	{
		return 'hello world';
	}

	public function html() : string
	{
		$templatePath = 'index.php';
		return $this->container->get('PhpRenderer')->fetch($templatePath, ['name' => 'tony']);
	}

	public function addProduct() : string
	{
		$newProductName = 'test';
		$product = new Product();
		$product->setName($newProductName);
		$entityManager = $this->container->get('entityManager');
		$entityManager->persist($product);
		$entityManager->flush();

		$templatePath = 'index.php';
		return $this->container->get('PhpRenderer')->fetch($templatePath, ['name' => $product->getId()]);
	}

	public function viewTest() : string
	{
		return $this->view(['test'=>'qwesdsfsd']);
	}
}
