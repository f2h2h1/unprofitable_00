<?php
namespace GPojectPHP;

class Renderer
{
	private $viewPath;

	public function __construct(string $viewPath = '')
	{
		$this->viewPath = $viewPath;
	}

	public function getViewPath() : ?string
	{
		return $this->viewPath;
	}

	public function setViewPath(string $viewPath) : void
	{
		$this->viewPath = $viewPath;
	}

	public function fetch(string $viewName, array $viewData = []) : ?string
	{
		$viewFullPath = $this->viewPath . $viewName;

		try
		{
			ob_start();

			(function () use ($viewFullPath, $viewData)
			{
				extract($viewData);
				include $viewFullPath;
			})();

			$output = ob_get_clean();
		}
		catch(\Throwable $e)
		{
			ob_end_clean();
			throw $e;
		}

		return $output;
	}
}
