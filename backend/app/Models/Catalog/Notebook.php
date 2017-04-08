<?php

namespace App\Models\Catalog;

use App\Models\Image;
use App\Models\Catalog;
use App\Traits\Relations\BelongTo\ColorBodyTrait;
use App\Traits\Relations\BelongTo\ColorRoofTrait;
use App\Traits\Relations\BelongTo\ComputerTypeTrait;
use App\Traits\Relations\BelongTo\CursorControlTypeTrait;
use App\Traits\Relations\BelongTo\GraphicCardTrait;
use App\Traits\Relations\BelongTo\GraphicCardTypeTrait;
use App\Traits\Relations\BelongTo\GraphicMemorySizeTrait;
use App\Traits\Relations\BelongTo\HddSizeTrait;
use App\Traits\Relations\BelongTo\MaterialBodyTrait;
use App\Traits\Relations\BelongTo\MaterialRoofTrait;
use App\Traits\Relations\BelongTo\ProcessorCoreTrait;
use App\Traits\Relations\BelongTo\ProcessorStageTrait;
use App\Traits\Relations\BelongTo\ProcessorTrait;
use App\Traits\Relations\BelongTo\RamMaxSizeTrait;
use App\Traits\Relations\BelongTo\RamSizeTrait;
use App\Traits\Relations\BelongTo\RamTypeTrait;
use App\Traits\Relations\BelongTo\ScreenDiagonalTrait;
use App\Traits\Relations\BelongTo\ScreenResolutionTrait;
use App\Traits\Relations\BelongTo\ScreenSurfaceTrait;
use App\Traits\Relations\BelongTo\ScreenTypeTrait;
use App\Traits\Relations\BelongTo\SsdSizeTrait;
use App\Traits\Relations\BelongTo\YearTrait;
use App\Traits\Relations\BelongToMany\ComplectsTrait;
use App\Traits\Relations\BelongToMany\HddTypesTrait;
use App\Traits\Relations\BelongToMany\MemoryCardsTrait;
use App\Traits\Relations\BelongToMany\TvTunersTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notebook
 * @package App\Models\Catalog
 */
class Notebook extends Catalog
{
    use SoftDeletes;
    use ComputerTypeTrait;
    use ProcessorStageTrait;
    use YearTrait;
    use ProcessorTrait;
    use ProcessorCoreTrait;
    use ColorBodyTrait;
    use ColorRoofTrait;
    use MaterialBodyTrait;
    use MaterialRoofTrait;
    use ScreenDiagonalTrait;
    use ScreenResolutionTrait;
    use ScreenTypeTrait;
    use ScreenSurfaceTrait;
    use RamTypeTrait;
    use HddTypesTrait;
    use RamSizeTrait;
    use RamMaxSizeTrait;
    use HddSizeTrait;
    use MemoryCardsTrait;
    use GraphicCardTrait;
    use GraphicCardTypeTrait;
    use GraphicMemorySizeTrait;
    use CursorControlTypeTrait;
    use TvTunersTrait;
    use ComplectsTrait;
    use SsdSizeTrait;
    use ProcessorCoreTrait;

    const PRODUCT_TITLE = "Ноутбук";
    const SYSTEM_NAME = 'notebook';

    protected $casts = [
        'transformer' => 'boolean',
        'body_backlight' => 'boolean',
        'shockproof' => 'boolean',
        'touch_screen' => 'boolean',
        'pen_input_support' => 'boolean',
        'screen_3d' => 'boolean',
        'ood' => 'boolean',
        'numpad' => 'boolean',
        'keyboard_backlight' => 'boolean',
        'keyboard_kirill' => 'boolean',
        'multi_touch_panel' => 'boolean',
        'fingerprint_scanner' => 'boolean',
        'eyes_control' => 'boolean',
        'nfc' => 'boolean',
        'bluetooth' => 'boolean',
        'wi_fi' => 'boolean',
        'mobile_connect' => 'boolean',
        'second_battery' => 'boolean',
        'is_popular' => 'boolean',
        'mouse' => 'boolean',
        'bag' => 'boolean',
        'is_memory_cards' => 'boolean',
        'touch_force' => 'boolean',
        'input_usb20' => 'integer',
        'input_usb30' => 'integer',
        'input_usb31a' => 'integer',
        'input_usb31b' => 'integer',
        'input_usb31c' => 'integer',
        'input_vga' => 'integer',
        'input_hdmi' => 'integer',
        'input_display_port' => 'integer',
        'input_thunderbolt' => 'integer',
        'input_audio' => 'integer',
        'width' => 'double',
        'depth' => 'double',
        'thickness' => 'double',
        'weight' => 'double',
        'hdd_rotational_speed' => 'integer',
        'build_in_speakers' => 'integer',
        'build_in_microphone' => 'integer',
        'build_in_camera_pixels' => 'integer',
        'build_in_camera' => 'integer',
        'battery_cells' => 'integer',
        'energy_reserve' => 'integer',
        'working_hours' => 'integer',
        'lan' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @param string $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param int $productType
     * @param bool $isGeneralImage
     * @return Image[]
     */
    public function getImages($productType = Image::PRODUCT_TYPE_NOTEBOOK, $isGeneralImage = false)
    {
        return parent::getImages($productType, $isGeneralImage);
    }

    /**
     * @param int $productType
     * @return string
     */
    public function getBigImage($productType = Image::PRODUCT_TYPE_NOTEBOOK)
    {
        return parent::getBigImage($productType);
    }

    /**
     * @param int $productType
     * @return string
     */
    public function getSmallImage($productType = Image::PRODUCT_TYPE_NOTEBOOK)
    {
        return parent::getSmallImage($productType);
    }

    public function setImages($images, $isGeneral = false, $productType = Image::PRODUCT_TYPE_NOTEBOOK)
    {
        parent::setImages($images, $isGeneral, $productType);
    }

    /**
     * @return boolean
     */
    public function isTransformer()
    {
        return $this->transformer;
    }

    /**
     * @param boolean $isTransformer
     */
    public function setTransformer($isTransformer)
    {
        $this->transformer = $isTransformer ? 1 : 0;
    }

    /**
     * @return string
     */
    public function getProcessorModel()
    {
        return $this->processor_model;
    }

    /**
     * @param string $processorModel
     */
    public function setProcessorModel($processorModel)
    {
        $this->processor_model = $processorModel;
    }

    /**
     * @param bool $details
     * @return string
     */
    public function getProcessorClockFrequency($details = false)
    {
        if ($this->processor_clock_frequency) {
            return $this->processor_clock_frequency.$details ? ' МГц' : '';
        }
    }

    /**
     * @param int $processorClockFrequency
     */
    public function setProcessorClockFrequency($processorClockFrequency)
    {
        $this->processor_clock_frequency = $processorClockFrequency;
    }

    /**
     * @return int
     */
    public function getProcessorTurboClockFrequency()
    {
        return $this->processor_turbo_clock_frequency;
    }

    /**
     * @param int $processorTurboClockFrequency
     */
    public function setProcessorTurboClockFrequency($processorTurboClockFrequency)
    {
        $this->processor_turbo_clock_frequency = $processorTurboClockFrequency;
    }

    /**
     * @return int
     */
    public function getProcessorTdp()
    {
        return $this->processor_tdp;
    }

    /**
     * @param int $processorTdp
     */
    public function setProcessorTdp($processorTdp)
    {
        $this->processor_tdp = $processorTdp;
    }

    /**
     * @return boolean
     */
    public function isBodyBacklight()
    {
        return $this->body_backlight;
    }

    /**
     * @param boolean $isBodyBacklight
     */
    public function setBodyBacklight($isBodyBacklight)
    {
        $this->body_backlight = $isBodyBacklight ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isShockproof()
    {
        return $this->shockproof;
    }

    /**
     * @param boolean $isShockproof
     */
    public function setShockproof($isShockproof)
    {
        $this->shockproof = $isShockproof ? 1 : 0;
    }

    /**
     * @return double
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param double $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return double
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param double $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return double
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * @param double $thickness
     */
    public function setThickness($thickness)
    {
        $this->thickness = $thickness;
    }

    /**
     * @return double
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param double $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return boolean
     */
    public function isTouchScreen()
    {
        return $this->touch_screen;
    }

    /**
     * @param boolean $isTouchScreen
     */
    public function setTouchScreen($isTouchScreen)
    {
        $this->touch_screen = $isTouchScreen ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isPenInputSupport()
    {
        return $this->pen_input_support;
    }

    /**
     * @param boolean $isPenInputSupport
     */
    public function setPenInputSupport($isPenInputSupport)
    {
        $this->pen_input_support = $isPenInputSupport ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isScreen3d()
    {
        return $this->screen_3d;
    }

    /**
     * @param boolean $isScreen3d
     */
    public function setScreen3d($isScreen3d)
    {
        $this->screen_3d = $isScreen3d ? 1 : 0;
    }

    /**
     * @return int
     */
    public function getHddRotationalSpeed()
    {
        return $this->hdd_rotational_speed;
    }

    /**
     * @param int $hddRotationalSpeed
     */
    public function setHddRotationalSpeed($hddRotationalSpeed)
    {
        $this->hdd_rotational_speed = $hddRotationalSpeed;
    }

    /**
     * @return boolean
     */
    public function isOod()
    {
        return $this->ood;
    }

    /**
     * @param boolean $IsOod
     */
    public function setOod($IsOod)
    {
        $this->ood = $IsOod ? 1 : 0;
    }

    public function isMemoryCards()
    {
        return $this->is_memory_cards;
    }

    public function setIsMemoryCards($isMemoryCards)
    {
        $this->is_memory_cards = $isMemoryCards ? 1 : 0;
    }

    /**
     * @return string
     */
    public function getGraphicCardModel()
    {
        return $this->graphic_card_model;
    }

    /**
     * @param string $graphicCardModel
     */
    public function setGraphicCardModel($graphicCardModel)
    {
        $this->graphic_card_model = $graphicCardModel;
    }

    /**
     * @return int
     */
    public function getBuildInCamera()
    {
        return $this->build_in_camera;
    }

    /**
     * @param int $buildInCamera
     */
    public function setBuildInCamera($buildInCamera)
    {
        $this->build_in_camera = $buildInCamera;
    }

    /**
     * @return int
     */
    public function getBuildInCameraPixels()
    {
        return $this->build_in_camera_pixels;
    }

    /**
     * @param int $buildInCameraPixels
     */
    public function setBuildInCameraPixels($buildInCameraPixels)
    {
        $this->build_in_camera_pixels = $buildInCameraPixels;
    }

    /**
     * @return int
     */
    public function getBuildInMicrophone()
    {
        return $this->build_in_microphone;
    }

    /**
     * @param int $buildInMicrophone
     */
    public function setBuildInMicrophone($buildInMicrophone)
    {
        $this->build_in_microphone = $buildInMicrophone;
    }

    /**
     * @return int
     */
    public function getBuildInSpeakers()
    {
        return $this->build_in_speakers;
    }

    /**
     * @param int $buildInSpeakers
     */
    public function setBuildInSpeakers($buildInSpeakers)
    {
        $this->build_in_speakers = $buildInSpeakers;
    }

    /**
     * @return boolean
     */
    public function isNumpad()
    {
        return $this->numpad;
    }

    /**
     * @param boolean $isNumpad
     */
    public function setNumpad($isNumpad)
    {
        $this->numpad = $isNumpad ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isKeyboardBacklight()
    {
        return $this->keyboard_backlight;
    }

    /**
     * @param boolean $isKeyboardBacklight
     */
    public function setKeyboardBacklight($isKeyboardBacklight)
    {
        $this->keyboard_backlight = $isKeyboardBacklight ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isKeyboardKirill()
    {
        return $this->keyboard_kirill;
    }

    /**
     * @param boolean $isKeyboardKirill
     */
    public function setKeyboardKirill($isKeyboardKirill)
    {
        $this->keyboard_kirill = $isKeyboardKirill ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isMultiTouchPanel()
    {
        return $this->multi_touch_panel;
    }

    /**
     * @param boolean $isMultiTouchPanel
     */
    public function setMultiTouchPanel($isMultiTouchPanel)
    {
        $this->multi_touch_panel = $isMultiTouchPanel ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isFingerprintScanner()
    {
        return $this->fingerprint_scanner;
    }

    /**
     * @param boolean $isFingerprintScanner
     */
    public function setFingerprintScanner($isFingerprintScanner)
    {
        $this->fingerprint_scanner = $isFingerprintScanner ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isNfc()
    {
        return $this->nfc;
    }

    /**
     * @param boolean $isNfc
     */
    public function setNfc($isNfc)
    {
        $this->nfc = $isNfc ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isEyesControl()
    {
        return $this->eyes_control;

    }

    /**
     * @param boolean $isEyesControl
     */
    public function setEyesControl($isEyesControl)
    {
        $this->eyes_control = $isEyesControl ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isBluetooth()
    {
        return $this->bluetooth;

    }

    /**
     * @param boolean $isBluetooth
     */
    public function setBluetooth($isBluetooth)
    {
        $this->bluetooth = $isBluetooth ? 1 : 0;
    }

    /**
     * @return int
     */
    public function getLan()
    {
        return $this->lan;

    }

    /**
     * @param int $lan
     */
    public function setLan($lan)
    {
        $this->lan = $lan;
    }

    /**
     * @return boolean
     */
    public function isWiFi()
    {
        return $this->wi_fi;
    }

    /**
     * @param boolean $isWiFi
     */
    public function setWiFi($isWiFi)
    {
        $this->wi_fi = $isWiFi ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isMobileConnect()
    {
        return $this->mobile_connect;

    }

    public function isPopular()
    {
        return $this->is_popular;
    }

    public function setIsPopular($isPopular)
    {
        $this->is_popular = $isPopular ? 1 : 0;
    }

    /**
     * @param boolean $isMobileConnect
     */
    public function setMobileConnect($isMobileConnect)
    {
        $this->mobile_connect = $isMobileConnect ? 1 : 0;
    }

    /**
     * @return int
     */
    public function getInputUsb20()
    {
        return $this->input_usb20;

    }

    /**
     * @param int $inputUsb20
     */
    public function setInputUsb20($inputUsb20)
    {
        $this->input_usb20 = $inputUsb20;
    }

    /**
     * @return int
     */
    public function getInputUsb30()
    {
        return $this->input_usb30;
    }

    /**
     * @param int $inputUsb30
     */
    public function setInputUsb30($inputUsb30)
    {
        $this->input_usb30 = $inputUsb30;
    }

    /**
     * @return int
     */
    public function getInputUsb31A()
    {
        return $this->input_usb31a;
    }

    /**
     * @param int $inputUsb31A
     */
    public function setInputUsb31A($inputUsb31A)
    {
        $this->input_usb31b = $inputUsb31A;
    }

    /**
     * @return int
     */
    public function getInputUsb31B()
    {
        return $this->input_usb31b;
    }

    /**
     * @param int $inputUsb31B
     */
    public function setInputUsb31B($inputUsb31B)
    {
        $this->input_usb31b = $inputUsb31B;
    }

    /**
     * @return int
     */
    public function getInputUsb31C()
    {
        return $this->input_usb31c;
    }

    /**
     * @param int $inputUsb31C
     */
    public function setInputUsb31C($inputUsb31C)
    {
        $this->input_usb31c = $inputUsb31C;
    }

    /**
     * @return int
     */
    public function getInputVga()
    {
        return $this->input_vga;

    }

    /**
     * @param int $inputVga
     */
    public function setInputVga($inputVga)
    {
        $this->input_vga = $inputVga;
    }

    /**
     * @return int
     */
    public function getInputHdmi()
    {
        return $this->input_hdmi;

    }

    /**
     * @param int $inputHdmi
     */
    public function setInputHdmi($inputHdmi)
    {
        $this->input_hdmi = $inputHdmi;
    }

    /**
     * @return int
     */
    public function getInputDisplayPort()
    {
        return $this->input_display_port;
    }

    /**
     * @param int $inputDisplayPort
     */
    public function setInputDisplayPort($inputDisplayPort)
    {
        $this->input_display_port = $inputDisplayPort;
    }

    /**
     * @return int
     */
    public function getInputThunderbolt()
    {
        return $this->input_thunderbolt;

    }

    /**
     * @param int $inputThunderbolt
     */
    public function setInputThunderbolt($inputThunderbolt)
    {
        $this->input_thunderbolt = $inputThunderbolt;
    }

    /**
     * @return int
     */
    public function getInputAudio()
    {
        return $this->input_audio;

    }

    /**
     * @param int $inputAudio
     */
    public function setInputAudio($inputAudio)
    {
        $this->input_audio = $inputAudio;
    }

    /**
     * @return int
     */
    public function getBatteryCells()
    {
        return $this->battery_cells;
    }

    /**
     * @param int $batteryCells
     */
    public function setBatteryCells($batteryCells)
    {
        $this->battery_cells = $batteryCells;
    }

    /**
     * @return int
     */
    public function getEnergyReserve()
    {
        return $this->energy_reserve;
    }

    /**
     * @param int $energyReserve
     */
    public function setEnergyReserve($energyReserve)
    {
        $this->energy_reserve = $energyReserve;
    }

    /**
     * @return int
     */
    public function getWorkingHours()
    {
        return $this->working_hours;
    }

    /**
     * @param int $workingHours
     */
    public function setWorkingHours($workingHours)
    {
        $this->working_hours = $workingHours;
    }

    /**
     * @return boolean
     */
    public function isSecondBattery()
    {
        return $this->second_battery;
    }

    /**
     * @param boolean $isSecondBattery
     */
    public function setSecondBattery($isSecondBattery)
    {
        $this->second_battery = $isSecondBattery ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isMouse()
    {
        return $this->mouse;
    }

    /**
     * @param boolean $isMouse
     */
    public function setMouse($isMouse)
    {
        $this->mouse = $isMouse ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isBag()
    {
        return $this->bag;
    }

    /**
     * @param boolean $isBag
     */
    public function setBag($isBag)
    {
        $this->bag = $isBag ? 1 : 0;
    }

    /**
     * @return boolean
     */
    public function isTouchForce()
    {
        return $this->touch_force;
    }

    /**
     * @param boolean $isTouchForce
     */
    public function setTouchForce($isTouchForce)
    {
        $this->touch_force = $isTouchForce ? 1 : 0;
    }

    public function getName()
    {
        return $this->getBrand()->getName().' '.$this->getModel();
    }

    public function getFullName()
    {
        return self::PRODUCT_TITLE.' '.$this->getName();
    }

    public function getLink($systemName = self::SYSTEM_NAME, $customModel = '')
    {
        return parent::getLink($systemName, $this->getConfig());
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getDescription()
    {
        $description = '';
        $screenDescription = $this->getScreenDiagonal()->getName()
            .' '.$this->getScreenResolution()->getName()
            .' '.$this->getScreenSurface()->getName();
        if (trim($screenDescription)) {
            $description .= trim($screenDescription);
        }
        $processorDescription = $this->getProcessor()->getName()
            .' '.$this->getProcessorModel()
            .' '.$this->getProcessorClockFrequency(true);
        if (trim($processorDescription)) {
            $description .= ', '.trim($processorDescription);
        }
        $ramDescription = $this->getRamSize()->getNameWithDetails();
        if (trim($ramDescription)) {
            $description .= ', '.trim($ramDescription);
        }
        $hddDescription = $this->getHddSize()->getNameWithDetails()
            .' ('.$this->getHddTypesLikeString().')';
        if (trim($hddDescription)) {
            $description .= ', '.trim($hddDescription);
        }
        $graphicDescription = $this->getGraphicCard()->getName()
            .' '.$this->getGraphicCardModel();
        if (trim($graphicDescription)) {
            $description .= ', '.trim($graphicDescription);
        }
        $colorRoofDescription = $this->getColorRoof()->getNameWithDetails('цвет крышки');
        if (trim($colorRoofDescription)) {
            $description .= ', '.trim($colorRoofDescription);
        }
        $colorBodyDescription = $this->getColorBody()->getNameWithDetails('цвет корпуса');
        if (trim($colorBodyDescription)) {
            $description .= ', '.trim($colorBodyDescription);
        }

        return $description;
    }
}
