<?php

/**
 * User: Martinus - Samuel Szabo
 * Date: 24.11.2017
 */

namespace Salamek\PplMyApi;

use Salamek\PplMyApi\Enum\PackageService;
use Salamek\PplMyApi\Enum\Product;
use Salamek\PplMyApi\Enum\Country;
use Salamek\PplMyApi\Exception\NotImplementedException;
use Salamek\PplMyApi\Model\IPackage;
use Salamek\PplMyApi\Model\Package;

class ZplLabel {

    /**
     * @param IPackage[] $packages
     * @param null $decomposition
     * @return string
     * @throws \Exception
     */
    public static function generateLabels(array $packages, $decomposition = null) {
        if (!is_null($decomposition)) {
            throw new \InvalidArgumentException('ZplLabel::generateLabels does not support $decomposition');
        }

        $packageNumbers = [];

        $zplString = '';
        /**
         *
         *
         * @var Package $package
         */
        foreach ($packages AS $package) {
            $zplString .= self::generateLabel($package);
        }

        return $zplString;
    }

    /**
     * @param IPackage $package
     * @return string
     */
    public static function generateLabel(IPackage $package) {
        //page setup
        $zpl = '^XA^MUM^LH2,2^LS0^PON';

        //font and utf8
        $zpl .= '^CW0,E:OSWALDSB.TTF^CI28';

        //ppl logo:
        $zpl .= '^FO90,105^GFA,2520,2520,9,00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004000000000000000007C00000000000000007F80000000000000001FE0000000000000000FE0000000000000000E60000000000000000E601E00000000000006601FE0000000000007E01FFC000000000043E01FFC40000000007C001FFC78000000007F801FFC7F800000000FE01FFC7FC000000007E01FFC7FCE00000006601FFC7FCFE0000046601FFC7FCFE000007E601FFC7FCFE380007FE01FFC7FCFE380000BE01FFC7FCFE3800001E01FFC7FCFE380003E001FFC7FCFE380007F801FFC7FCFE38000E3C01FFC7FCFE38000E0E01FFC7FCFE38000E0601FFC7FCFE3800060601FFC7FCFE3800070701FFC7FCFE380003C601FFC7FCFE380001FE01FFC7FCFE380000FC01FFC7FCFE3800070001FFC7FCFE380007F001FFC7FCFE380003FE01FFC7FCFE3800007E01FFC7FCFE3800006601FFC7FCFE3800006601FFC7FCFE3800006601FFC7FCFE3800006601FFC7FCFE3800070601FFC7FCFE380007E601FFC7FCFE380007FE01FFC7FCFE3800067E01FFC7FCFE3800066601FFC7FCFE3800066601FFC7FCFE3800066601FFC7FCFE3800066601FFC7FCFE3800002601FFC7FCFE3800070601FFC7FCFE3800073801FFC7FCFE38000E7C01FFC7FCFE38000E7E01FFC7FCFE38000E66003FC7FCFE380006670007C7FCFE380007E7000047FCFE380003EE000007FCFE380001CE000000FCFE3800070C0000001CFE3800073000000000FE38000E7C000000003E38000E7E000000000638000E6600000000003800066701E0000000080007E701FC000000000003EE01FFC00000000001CE01FFF800000000070C01FFFF8000000007F001FFFFF000000001FE01FFFFFF000000003E01FFFFFFE0000003E201FFFFFFFE000007F801FFFFFFFFC000077C01FFFFFFFFF8000E0E01FFFFFFFFF8000E0601FFFFFFFFF800060601FFFFFFFFF800070701FFFFFFFFF800038701FFFFFFFFF80001FE01FFFFFFFFF80000FE01FFFFFFFFF800071801FFFFFFFFF80007F001FFFFFFFFF80001FE007FFFFFFFF800003E0007FFFFFFF800007E0000FFFFFFF80003FC00000FFFFFF80007C0000007FFFFF80007E0000007FFFFF80003FC000007FBFFF800047E000007F83FF8000706000007F807F8000780000007F803F80001E0000007F803F80001F8000007F803F80001BC000007F803F800019E000007F803F80007FE000007F803F80007FE000007F803F8000780000007F803F8000400000007F803F80007C0000007F803F80007F8000007F803F80006FE000007F803F800061E000007F803F8000600000007F803F8000600000007F803F8000600000007FC07F8000000000007FE07F8000000000007FF0FF8000000000007FFFFF8000000000003FFFFF8000000000003FFFFF8000000000003FFFFF8000000000003FFFFF8000000000003FFFFF8000400000001FFFFF8000780000001FFFFF80007F8000001FFFFF80001FE000000FFFFF00000FE000000FFFFF00000E60000007FFFF00000E60000007FFFE00000660000003FFFE000007E0000001FFFC000063E0000000FFF8000070C00000007FF800007C000000003FE000001E000000000FC000001F80080000000000001BC01F00000000000018E01FF000000000007FE01FFE00000000007FE01FFFC00000000040001FFFFC0000000040001FFFFF800000007C001FFFFFF80000007F801FFFFFFF0000000FE01FFFFFFFF0000006E01FFFFFFFFE000006601FFFFFFFFF800066601FFFFFFFFF80007E601FFFFFFFFF80007FE01FFFFFFFFF800003E01FFFFFFFFF800001E01FFFFFFFFF80007F001FFFFFFFFF80007F801FFFFFFFFF8000E3C01FFFFFFFFF8000E0E00FFFFFFFFF8000606003FFFFFFFF80006070003FFFFFFF800070700007FFFFFF800038E000007FFFFF800001E000007FFFFF800070C000007FFFFF80007F0000007F9FFF80007FE000007F81FF800067E000007F803F8000666000007F803F8000666000007F803F8000666000007F803F8000666000007F803F8000026000007F803F8000706000007F803F80007F0000007F803F80007FE000007F803F800063E000007F803F8000606000007F803F8000600000007F803F8000600000007F803F8000200000007F803F8000000000007F803F8000000000007FC03F8000000000007FC07F8000000000007FE07F8000000000007FF9FF8000000000007FFFFF8000000000003FFFFF8000000000003FFFFF8000700000003FFFFF80007E0000003FFFFF80007FE000003FFFFF800067E000001FFFFF800060E000001FFFFF8000600000000FFFFF8000600000000FFFFF0000600000000FFFFF00000000000007FFFF00003F00000003FFFE00007F80000003FFFE000073C0000001FFFC0000E0E0000000FFF80000E0600000007FF0000060600000003FE000007070000000078000003C701C0000000000001FE01F8000000000000FE01FF800000000003E001FFF00000000007F001FFFF0000000007F801FFFFE00000000E1C01FFFFFE0000000E0E01FFFFFFC00000060601FFFFFFFC000006E701FFFFFFFF800007E701FFFFFFFFF00007EE01FFFFFFFFF80001EE01FFFFFFFFF800060C01FFFFFFFFF80007C001FFFFFFFFF80007FC01FFFFFFFFF800007E01FFFFFFFFF800070E01FFFFFFFFF800073801FFFFFFFFF8000E7C01FFFFFFFFF8000E7E01FFFFFFFFF8000E6601FFFFFFFFF800066701FFFFFFFFF80007E701FF9FFFFFF80003EE01FF83FFFFF80001CE01FF807FFFF800000C01FF8007FFF800000601FF8000FFF800070601FF80000FF80007E601FF800001F80003FE01FF8000001800007E01FF8000000000000601FF8000000000000601FF8000000000070601FF800000000007F601FF800000000003FE01FF8000000000003E01FF800000000003E601FF800000000007F801FF80000000000FFC01FF80000000000E0E01FF80000000000E0601FF8000000000060601FF8000000000070701FF8000000000038F01FF8000000000019E01FF8000000000000C01FF8000000000000001FF8000000000000001FF8000000000000001FF8000000000000000FF80000000000000001F80000000000000000380000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001F00000000000000007FC000000000000000C060000000000000014010000000000000037818000000000000063F0C0000000000000607EC0000000000000404E4000000000000040664000000000000040664000000000000046664000000000000067E6C000000000000020BE80000000000000301D800000000000001803000000000000000C060000000000000007FC0000000000000000E0000000000000000000000^FS';

        //boxes and static text
        $zpl .= '^FO45,55^GB44,80,0.3,B,0^FS';
        $zpl .= '^FO16,55^GB26,80,0.3,B,0^FS';
        $zpl .= '^FO0,118^GB9,17,0.3,B,0^FS';
        $zpl .= '^FO89,55^A0R,2^FDConsignee / Příjemce^FS';
        $zpl .= '^FO42,55^A0R,2^FDConsignor / Odesílatel^FS';
        $zpl .= '^FO42,108^A0R,2^FDDatum tisku etikety: ' . date_create()->format('j.n.Y') . '^FS';
        $zpl .= '^FO89,85^A0R,2^FDhttp://www.ppl.cz^FS';

        //COD
        if (in_array($package->getPackageProductType(), Product::$cashOnDelivery)) {
            $zpl .= sprintf('^FO1,55^A0R,6,5^FDCOD/DOB: %.2f %s^FS', $package->getPaymentInfo()->getCashOnDeliveryPrice(), $package->getPaymentInfo()->getCashOnDeliveryCurrency());
        }

        //package number and barcodes
        $zpl .= sprintf('^FO5,20^BY0.4,3,32^BCN,28,N,N^FD%s-%s^FS', $package->getPackageNumber(), $package->getRouteCode());
        $zpl .= sprintf('^FO36,49^A0N,3^FD%s-%s^FS', $package->getPackageNumber(), $package->getRouteCode());
        $zpl .= sprintf('^FO16,95^BY0.4,2,10^B2R,9,N,N,Y^FD%s^FS', $package->getPackageNumber());
        $zpl .= sprintf('^FO9,100^A0R,5^FD%s^FS', $package->getPackageNumber());

        //recipient
        $zpl .= sprintf('^FO82,58^A0R,4^FD%s^FS', $package->getRecipient()->getName2());
        $zpl .= sprintf('^FO77,58^A0R,4^FD%s^FS', $package->getRecipient()->getName());
        $zpl .= sprintf('^FO72,58^A0R,4^FD%s^FS', $package->getRecipient()->getStreet());
        $zpl .= sprintf('^FO67,58^A0R,4^FD%s^FS', $package->getRecipient()->getCity());
        $zpl .= sprintf('^FO57,58^A0R,8^FD%s^FS', $package->getRecipient()->getZipCode());
        $zpl .= sprintf('^FO53,58^A0R,3^FD%s^FS', $package->getRecipient()->getContact());
        $zpl .= sprintf('^FO48,58^A0R,3^FDTel: %s^FS', $package->getRecipient()->getPhone());
        if ($package->getRecipient()->getCountry() <> Country::CZ) {
            $zpl .= '^FO45,120^GB11,15,0.3,B,0^FS';
            $zpl .= sprintf('^FO44,122^A0R,10^FD%s^FS', $package->getRecipient()->getCountry());
        }

        //sender
        $zpl .= sprintf('^FO35,58^A0R,4^FD%s^FS', $package->getSender()->getName());
        $zpl .= sprintf('^FO30,58^A0R,4^FD%s^FS', $package->getSender()->getStreet());
        $zpl .= sprintf('^FO25,58^A0R,4^FD%s^FS', $package->getSender()->getCity());
        $zpl .= sprintf('^FO20,58^A0R,4^FD%s^FS', $package->getSender()->getZipCode());

        //package count
        $zpl .= sprintf('^FO0,122^A0R,7^FD%s/%s^FS', $package->getPackagePosition(), $package->getPackageCount());

        //package routing ZIP
        $zpl .= sprintf('^FO35,3^A0N,7^FD%s^FS', $package->getRecipient()->getZipCode());

        //package routing route code
        $zpl .= sprintf('^FO65,3^A0N,10^FD%s^FS', $package->getRouteCode());

        //package routing depo
        if ($package->getRouteDepoHighlighted()) {
            $zpl .= sprintf('^FO5,2^GB18,17,1,B,0^FS');
        }
        $zpl .= sprintf('^FO7,6^A0N,13^FD%s^FS', $package->getRouteDepoCode());

        //package routing country
        if ($package->getRecipient()->getCountry() <> Country::CZ) {
            $zpl .= sprintf('^FO65,12^A0N,10^FD%s^FS', $package->getRecipient()->getCountry());
        }

        //package routing service
        if ($package->getRecipient()->getCountry() <> Country::CZ) {
            $zpl .= sprintf('^FO35,13^A0N,7^FD%s^FS', in_array($package->getPackageProductType(), Product::$cashOnDelivery) ? 'COD' : '');
        } else {
            $zpl .= sprintf('^FO35,13^A0N,7^FD%s^FS', in_array(PackageService::EVENING_DELIVERY, \Salamek\PplMyApi\Model\PackageService::packageServicesToArray($package)) ? 'VEČER' : '');
        }

        //package type
        $zpl .= sprintf('^FO92,55^A0R,3^FD%s^FS', Product::getName($package->getPackageProductType()));

        //comment and reference
        //$zpl .= sprintf('^FO12, 58^A0R, 3^FDPozn.: poznámka^FS');
        //$zpl .= sprintf('^FO9, 58^A0R, 3^FDRef.: externí reference^FS');
        //reset page setup
        $zpl .= '^LH0,0';
        //end
        $zpl .= '^XZ';

        return $zpl;
    }

    /**
     * @param $pdf
     * @param $package
     * @throws \Exception
     */
    public static function generateLabelFull($pdf, $package) {
        throw new NotImplementedException();
    }

    /**
     * @param $pdf
     * @param $package
     * @param $position
     * @throws \Exception
     */
    public static function generateLabelQuarter($pdf, $package, $position = null) {
        throw new NotImplementedException();
    }

}
