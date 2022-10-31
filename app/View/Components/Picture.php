<?php
namespace App\View\Components;
use Illuminate\View\Component;

class Picture extends Component
{
  /**
   * Image
   *
   * @var object
   */
  public $image;

  /**
   * Caption
   *
   * @var string
   */
  public $caption;

  /**
   * Width
   *
   * @var integer
   */
  public $width;

  /**
   * Height
   *
   * @var integer
   */
  public $height;


  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($image = NULL, $caption = NULL, $width = NULL, $height = NULL)
  {
    $this->image    = $image;
    $this->caption  = $caption;
    $this->width    = $width;
    $this->height   = $height;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('frontend.components.picture');
  }
}
