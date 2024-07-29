<?php

declare(strict_types = 1);

namespace imperazim\ui\form;

use pocketmine\player\Player;

use imperazim\ui\UiManager;
use imperazim\components\ui\Form;
use imperazim\vendor\libform\Form as IForm;
use imperazim\vendor\libform\elements\Title;
use imperazim\vendor\libform\elements\Element;
use imperazim\vendor\libform\types\CustomForm;
use imperazim\vendor\libform\interaction\CustomElementsResponse;

/**
* Class CustomFormExample
* @package imperazim\ui\form
*/
class CustomFormExample extends Form {

  /**
  * Defines the form structure.
  * @return IForm
  */
  public function structure(): IForm {
    return new CustomForm(
      title: $this->getTitle(),
      elements: $this->getElements(),
      onSubmit: fn($player, $response) => $this->handleSubmit($player, $response),
      onClose: fn($player) => $this->handleClose($player)
    );
  }

  /**
  * Gets the title.
  * @return Title
  */
  private function getTitle(): Title {
    $file = UiManager::getFile('forms');
    return new Title(
      text: $file->get('custom_form.title', '')
    );
  }

  /**
  * Retrieves an array of elements for each available class.
  * @return Element[]
  */
  private function getElements(): array {
    $player = $this->getPlayer();
    $file = UiManager::getFile('forms');
    $buttonList = $file->get('long_form.elements', []);

    $elements = [];
    foreach ($elementList as $token => $elementData) {
      try {
        $type = $elementData['type'];
        $data = $elementData['data'];
        $element = str_replace(
          'Element',
          $type,
          Element::class
        );
        $elements[] = new $element(...$data);
      } catch (\Exception $e) {
        new crashdump($e);
      }
    }
    return $elements;
  }

  /**
  * Handles the form submission and returns the next form to display.
  * @param Player $player
  * @param CustomElementsResponse $response
  */
  private function handleSubmit(Player $player, CustomElementsResponse $response): void {
    /**
    * Because the elements are automatically generated by the config, I will not add the functionality to the code, but I will leave a detailed text for everything!
    *
    *
    * NOTICE: The CustomElementsResponse Cost disregards Label elements as they are not interactive.
    * $id = indicative index of the element defined in getElements starting at 0 and disregarding Label elements.
    * $response->getElementResult($id)
    * or
    * $response->getValues($id) which returns the direct value

    $input = $response->getElement('input_identifier');
    $inputValue = $input->getValue();
    # $sliderValue: Returns the text written in the text box called.

    $slider = $response->getElement('slider_identifier');
    $sliderValue = $slider->getValue();
    # $sliderValue: Returns the numeric value chosen in the called slider.

    $stepSlider = $response->getElement('step_slider_identifier');
    $stepSliderIndexValue = $stepSlider->getValue();
    $stepSliderOptionsValue = $stepSlider->getSelectedOption();
    # $stepSliderIndexValue: Returns the index value of the chosen option according to the array passed in the called StepSlider.
    # $stepSliderOptionsValue: Returns the text of the chosen option according to the array passed in the called StepSlider.

    $toggle = $response->getElement('toggle_identifier');
    $toggleValue = $toggle->getValue();
    # $toggleValue: Returns true/false according to the button toggle called.

    $dropdown = $response->getElement('dropdown_identifier');
    $dropdownIndexValue = $dropdown->getValue();
    $dropdownOptionsValue = $dropdown->getSelectedOption();
    # $dropdownIndexValue: Returns the index value of the chosen option according to the array passed in the called Dropdown.
    # $dropdownOptionValue: Returns the text of the chosen option according to the array passed in the called Dropdown.

    */
  }

  /**
  * Handles the form closure and returns the next form to display.
  * @param Player $player
  */
  private function handleClose(Player $player): void {
    $player->sendMessage('LongForm closed!');
  }
}