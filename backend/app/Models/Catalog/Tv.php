<?php

namespace App\Models\Catalog;

use App\Models\Database\Brand;
use App\Models\Image;
use App\Traits\Relations\BelongTo\ColorBodyTrait;
use App\Traits\Relations\BelongTo\ColorBorderTrait;
use App\Traits\Relations\BelongTo\ColorStandTrait;
use App\Traits\Relations\BelongTo\MatrixTypeTrait;
use App\Traits\Relations\BelongTo\ProcessorCoreTrait;
use App\Traits\Relations\BelongTo\ScreenAspectRatioTrait;
use App\Traits\Relations\BelongTo\ScreenDiagonalTrait;
use App\Traits\Relations\BelongTo\ScreenResolutionTrait;
use App\Traits\Relations\BelongTo\ScreenTypeTrait;
use App\Traits\Relations\BelongTo\StandTypeTrait;
use App\Traits\Relations\BelongTo\VesaWallMountTrait;
use App\Traits\Relations\BelongTo\YearTrait;
use App\Traits\Relations\BelongToMany\TvTunersTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Catalog;

class Tv extends Catalog
{
    use SoftDeletes;
    use YearTrait;
    use ScreenTypeTrait;
    use ScreenDiagonalTrait;
    use ScreenResolutionTrait;
    use ScreenAspectRatioTrait;
    use ColorBodyTrait;
    use ColorBorderTrait;
    use ColorStandTrait;
    use StandTypeTrait;
    use MatrixTypeTrait;
    use TvTunersTrait;
    use VesaWallMountTrait;
    use ProcessorCoreTrait;

    const PRODUCT_TITLE = "Телевизор";
    const SYSTEM_NAME = 'tvs';

    protected $casts = [
        'screen_curved' => 'boolean',
        'support_3d' => 'boolean',
        'smart_tv' => 'boolean',
        'local_dimming' => 'boolean',
        'led_backlight' => 'boolean',
        'hdr' => 'boolean',
        'wireless_video_transmission' => 'boolean',
        'video_camera' => 'boolean',
        'backligh' => 'boolean',
        'voice_control' => 'boolean',
        'subwoofer' => 'boolean',
        'dts' => 'boolean',
        'is_two_tuners' => 'boolean',
        'bluetooth' => 'boolean',
        'wi_fi' => 'boolean',
        'wi_fi_direct' => 'boolean',
        'remote_interface_unit' => 'boolean',
        'glasses_3d' => 'boolean',
        'wall_mount' => 'boolean',
        'is_popular' => 'boolean',
        'dynamic_scenes_quality_index' => 'integer',
        'screen_refresh_rate' => 'integer',
        'max_power_consumption' => 'integer',
        'build_in_speakers_power' => 'integer',
        'build_in_speakers_count' => 'integer',
        'input_display_port' => 'integer',
        'input_audio' => 'integer',
        'input_mhl' => 'integer',
        'input_component' => 'integer',
        'input_composite' => 'integer',
        'input_scart' => 'integer',
        'input_vga' => 'integer',
        'input_spdif' => 'integer',
        'input_hdmi' => 'integer',
        'input_headphones' => 'integer',
        'input_usb20' => 'integer',
        'input_usb30' => 'integer',
        'input_ethernet' => 'integer',
        'width' => 'integer',
        'height_with_stand' => 'integer',
        'thickness' => 'integer',
        'depth_with_stand' => 'integer',
        'weight' => 'integer',
    ];

    /**
     * @param Brand $brand
     * @param string $model
     * @return self
     */
    public static function getByBrandAndModel($brand, $model)
    {
        return self::where('brand_id', '=', $brand->getId())
            ->where('model', '=', $model)->first();
    }

    public function isScreenCurved()
    {
        return $this->screen_curved;
    }

    public function setScreenCurved($isScreenCurved)
    {
        $this->screen_curved = $isScreenCurved ? 1 : 0;
    }

    public function is3dSupport()
    {
        return $this->support_3d;
    }

    public function set3dSupport($isSupport3d)
    {
        $this->support_3d = $isSupport3d ? 1 : 0;
    }

    public function getDynamicScenesQualityIndex()
    {
        return $this->dynamic_scenes_quality_index;
    }

    public function setDynamicScenesQualityIndex($dynamicScenesQualityIndex)
    {
        $this->dynamic_scenes_quality_index = $dynamicScenesQualityIndex;
    }

    public function isSmartTv($details = false)
    {
        if ($details && $this->smart_tv) {
            return 'Smart TV';
        }

        return $this->smart_tv;
    }

    public function setSmartTv($isSmartTv)
    {
        $this->smart_tv = $isSmartTv ? 1 : 0;
    }

    public function isLocalDimming()
    {
        return $this->local_dimming;
    }

    public function setLocalDimming($isLocalDimming)
    {
        $this->local_dimming = $isLocalDimming ? 1 : 0;
    }

    public function isLedBacklight()
    {
        return $this->led_backlight;
    }

    public function setLedBacklight($isLedBacklight)
    {
        $this->led_backlight = $isLedBacklight ? 1 : 0;
    }

    public function isHdr()
    {
        return $this->hdr;
    }

    public function setHdr($isHdr)
    {
        $this->hdr = $isHdr ? 1 : 0;
    }

    public function isWirelessVideoTransmission()
    {
        return $this->wireless_video_transmission;
    }

    public function setWirelessVideoTransmission($isWirelessVideoTransmission)
    {
        $this->wireless_video_transmission = $isWirelessVideoTransmission ? 1 : 0;
    }

    public function isVideoCamera()
    {
        return $this->video_camera;
    }

    public function setVideoCamera($isVideoCamera)
    {
        $this->video_camera = $isVideoCamera ? 1 : 0;
    }

    public function isBacklight()
    {
        return $this->backligh;
    }

    public function setBacklight($isBacklight)
    {
        $this->backligh = $isBacklight ? 1 : 0;
    }

    public function isSubwoofer()
    {
        return $this->subwoofer;
    }

    public function setSubwoofer($isSubwoofer)
    {
        $this->subwoofer = $isSubwoofer ? 1 : 0;
    }

    public function isDts()
    {
        return $this->dts;
    }

    public function setDts($isDts)
    {
        $this->dts = $isDts ? 1 : 0;
    }

    public function isTwoTuners()
    {
        return $this->is_two_tuners;
    }

    public function setTwoTuners($isTwoTuners)
    {
        $this->is_two_tuners = $isTwoTuners ? 1 : 0;
    }

    public function isBluetooth()
    {
        return $this->bluetooth;
    }

    public function setBluetooth($isBluetooth)
    {
        $this->bluetooth = $isBluetooth ? 1 : 0;
    }

    public function isWiFi($details = false)
    {
        if ($details && $this->wi_fi) {
            return 'Wi-Fi';
        }

        return $this->wi_fi;
    }

    public function setWiFi($isWiFi)
    {
        $this->wi_fi = $isWiFi ? 1 : 0;
    }

    public function isWiFiDirect()
    {
        return $this->wi_fi_direct;
    }

    public function setWiFiDirect($isWiFiDirect)
    {
        $this->wi_fi_direct = $isWiFiDirect ? 1 : 0;
    }

    public function isRemoteInterfaceUnit()
    {
        return $this->remote_interface_unit;
    }

    public function setRemoteInterfaceUnit($isRemoteInterfaceUnit)
    {
        $this->remote_interface_unit = $isRemoteInterfaceUnit ? 1 : 0;
    }

    public function isGlasses3d()
    {
        return $this->glasses_3d;
    }

    public function setGlasses3d($isGlasses3d)
    {
        $this->glasses_3d = $isGlasses3d ? 1 : 0;
    }

    public function isWallMount()
    {
        return $this->wall_mount;
    }

    public function setWallMount($isWallMount)
    {
        $this->wall_mount = $isWallMount ? 1 : 0;
    }

    public function isSmartConsole()
    {
        return $this->smart_console;
    }

    public function setSmartConsole($isSmartConsole)
    {
        $this->smart_console = $isSmartConsole ? 1 : 0;
    }

    public function isVoiceControl()
    {
        return $this->voice_control;
    }

    public function setVoiceControl($isVoiceControl)
    {
        $this->voice_control = $isVoiceControl ? 1 : 0;
    }

    public function isPopular()
    {
        return $this->is_popular;
    }

    public function setIsPopular($isPopular)
    {
        $this->is_popular = $isPopular ? 1 : 0;
    }

    public function getScreenRefreshRate($details = false)
    {
        if ($this->screen_refresh_rate) {
            return $this->screen_refresh_rate.($details ? ' Гц' : '');
        }
    }

    public function setScreenRefreshRate($screenRefreshRate)
    {
        $this->screen_refresh_rate = $screenRefreshRate;
    }

    public function getMaxPowerConsumption($details = false)
    {
        if ($this->max_power_consumption) {
            return $this->max_power_consumption.($details ? ' Вт' : '');
        }
    }

    public function setMaxPowerConsumption($maxPowerConsumption)
    {
        $this->max_power_consumption = $maxPowerConsumption;
    }

    public function getBuildInSpeakersPower($details = false)
    {
        if ($this->build_in_speakers_power) {
            return $this->build_in_speakers_power.($details ? ' Вт' : '');
        }
    }

    public function setBuildInSpeakersPower($buildInSpeakersPower)
    {
        $this->build_in_speakers_power = $buildInSpeakersPower;
    }

    public function getBuildInSpeakersCount()
    {
        return $this->build_in_speakers_count;
    }

    public function setBuildInSpeakersCount($buildInSpeakersCount)
    {
        $this->build_in_speakers_count = $buildInSpeakersCount;
    }

    public function getInputDisplayPort()
    {
        return $this->input_display_port;
    }

    public function setInputDisplayPort($inputDisplayPort)
    {
        $this->input_display_port = $inputDisplayPort;
    }

    public function getInputAudio()
    {
        return $this->input_audio;
    }

    public function setInputAudio($inputAudio)
    {
        $this->input_audio = $inputAudio;
    }

    public function getInputMhl()
    {
        return $this->input_mhl;
    }

    public function setInputMhl($inputMhl)
    {
        $this->input_mhl = $inputMhl;
    }

    public function getInputComponent()
    {
        return $this->input_component;
    }

    public function setInputComponent($inputComponent)
    {
        $this->input_component = $inputComponent;
    }

    public function getInputComposite()
    {
        return $this->input_composite;
    }

    public function setInputComposite($inputComposite)
    {
        $this->input_composite = $inputComposite;
    }

    public function getInputScart()
    {
        return $this->input_scart;
    }

    public function setInputScart($inputScart)
    {
        $this->input_scart = $inputScart;
    }

    public function getInputVga()
    {
        return $this->input_vga;
    }

    public function setInputVga($inputVga)
    {
        $this->input_vga = $inputVga;
    }

    public function getInputHdmi()
    {
        return $this->input_hdmi;
    }

    public function setInputHdmi($inputHdmi)
    {
        $this->input_hdmi = $inputHdmi;
    }

    public function getInputSpdif()
    {
        return $this->input_spdif;
    }

    public function setInputSpdif($inputSpdif)
    {
        $this->input_spdif = $inputSpdif;
    }

    public function getInputHeadphones()
    {
        return $this->input_headphones;
    }

    public function setInputHeadphones($inputHeadphones)
    {
        $this->input_headphones = $inputHeadphones;
    }

    public function getInputUsb20()
    {
        return $this->input_usb20;
    }

    public function setInputUsb20($inputUsb20)
    {
        $this->input_usb20 = $inputUsb20;
    }

    public function getInputUsb30()
    {
        return $this->input_usb30;
    }

    public function setInputUsb30($inputUsb30)
    {
        return $this->input_usb30;
    }

    public function getInputEthernet()
    {
        return $this->input_ethernet;
    }

    public function setInputEthernet($inputEthernet)
    {
        $this->input_ethernet = $inputEthernet;
    }

    public function getWidth($details = false)
    {
        if ($this->width) {
            return $this->width.($details ? ' мм' : '');
        }
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getHeightWithStand($details = false)
    {
        if ($this->height_with_stand) {
            return $this->height_with_stand.($details ? ' мм' : '');
        }
    }

    public function setHeightWithStand($heightWithStand)
    {
        $this->height_with_stand = $heightWithStand;
    }

    public function getThickness($details = false)
    {
        if ($this->thickness) {
            return $this->thickness.($details ? ' мм' : '');
        }
    }

    public function setThickness($thickness)
    {
        $this->thickness = $thickness;
    }

    public function getDepthWithStand($details = false)
    {
        if ($this->depth_with_stand) {
            return $this->depth_with_stand.($details ? ' мм' : '');
        }
    }

    public function setDepthWithStand($depthWithStand)
    {
        $this->depth_with_stand = $depthWithStand;
    }

    public function getWeight($details = false)
    {
        if ($this->depth_with_stand) {
            return $this->depth_with_stand.($details ? ' г' : '');
        }
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @param int $productType
     * @param bool $isGeneralImage
     * @return Image[]
     */
    public function getImages($productType = Image::PRODUCT_TYPE_TV, $isGeneralImage = false)
    {
        return parent::getImages($productType, $isGeneralImage);
    }

    /**
     * @param int $productType
     * @return string
     */
    public function getBigImage($productType = Image::PRODUCT_TYPE_TV)
    {
        return parent::getBigImage($productType);
    }

    public function getBigImages($productType = Image::PRODUCT_TYPE_TV)
    {
        return parent::getBigImages($productType);
    }

    /**
     * @param int $productType
     * @return string
     */
    public function getSmallImage($productType = Image::PRODUCT_TYPE_TV)
    {
        return parent::getSmallImage($productType);
    }

    public function setImages($images, $isGeneral = false, $productType = Image::PRODUCT_TYPE_TV)
    {
        parent::setImages($images, $isGeneral, $productType);
    }

    public function getLink($systemName = self::SYSTEM_NAME, $customModel = '')
    {
        return parent::getLink($systemName);
    }

    public function getFullName()
    {
        return self::PRODUCT_TITLE.' '.$this->getName();
    }

    public function getName()
    {
        return $this->getBrand()->getName().' '.$this->getModel();
    }

    public function getDescription()
    {
        $description = '';
        $screenDescription = $this->getScreenDiagonal()->getName()
            .' '.$this->getScreenResolution()->getName()
            .' '.$this->getScreenAspectRatio()->getName()
            .' '.$this->getScreenType()->getName();
        if (trim($screenDescription)) {
            $description .= trim($screenDescription);
        }
        $matrixDescription = $this->getMatrixType()->getNameWithDetails();
        if (trim($matrixDescription)) {
            $description .= ', '.trim($matrixDescription);
        }
        $screenRefreshRateDescription = $this->getScreenRefreshRate(true);
        if (trim($screenRefreshRateDescription)) {
            $description .= ', частота '.trim($screenRefreshRateDescription);
        }
        $smartTvRateDescription = $this->isSmartTv(true);
        if (trim($smartTvRateDescription)) {
            $description .= ', '.trim($smartTvRateDescription);
        }
        $wiFiRateDescription = $this->isWiFi(true);
        if (trim($wiFiRateDescription)) {
            $description .= ', '.trim($wiFiRateDescription);
        }

        return $description;
    }
}
