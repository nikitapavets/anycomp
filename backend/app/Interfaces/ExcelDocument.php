<?php

namespace App\Interfaces;

use App\Models\Repair;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Facades\Excel;

class ExcelDocument implements Document
{
    /**
     * @param $fileInfo
     * @param $orgInfo
     * @param Repair $currentRepair
     */
    public function create($fileInfo, $orgInfo, $currentRepair)
    {

        Excel::create(
            $fileInfo['file_name'],
            function ($excel) use ($fileInfo, $orgInfo, $currentRepair) {

                $excel->sheet(
                    $fileInfo['list_name'],
                    function ($sheet) use ($currentRepair, $orgInfo) {

                        $sheet->setPageMargin(
                            array(
                                1.00,
                                0.70,
                                0.76,
                                0.70,
                            )
                        );
                        $sheet->setFontSize(10);

                        $sheet->setWidth(
                            array(
                                'A' => 5,
                                'B' => 5,
                                'C' => 5,
                                'D' => 5,
                                'E' => 5,
                                'F' => 5,
                                'G' => 5,
                                'H' => 5,
                                'I' => 5,
                                'J' => 5,
                                'K' => 5,
                                'L' => 5,
                                'M' => 5,
                                'N' => 5,
                                'O' => 5,
                                'P' => 5,
                                'Q' => 5,
                                'R' => 5,
                                'S' => 5,
                            )
                        );

                        $sheet->setHeight(
                            array(
                                17 => 25.5,
                                19 => 25.5,
                                21 => 25.5,
                                27 => 21,
                                28 => 7,
                                29 => 14,
                                30 => 14,
                                31 => 14,
                                32 => 7,
                                33 => 7,
                                34 => 14,
                                35 => 14,
                                36 => 7,
                                37 => 14,
                                38 => 7,
                                39 => 7,
                                40 => 14,
                                41 => 14,
                                42 => 7,
                                43 => 7,
                                45 => 18,
                            )
                        );

                        $sheet->setColumnFormat(
                            array(
                                'I' => '@',
                            )
                        );

                        $sheet->mergeCells('A1:S1');
                        $sheet->cell(
                            'A1',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue(
                                    $orgInfo['org_name'].' | '.$orgInfo['org_address'].' | тел. '.$orgInfo['org_phone']
                                );
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A3:H3');
                        $sheet->cell(
                            'A3',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Квитанция о приёме в ремонт №');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontWeight('bold');
                            }
                        );

                        $sheet->mergeCells('I3:K3');
                        $sheet->cell(
                            'I3',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getReceiptNumber());
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('M3:N3');
                        $sheet->cell(
                            'M3',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Дата');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('O3:S3');
                        $sheet->cell(
                            'O3',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getCreatedForPrintDate());
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A5:G5');
                        $sheet->cell(
                            'A5',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Ф.И.О. заказчика:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I5:S5');
                        $sheet->cell(
                            'I5',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getFullName());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A7:G7');
                        $sheet->cell(
                            'A7',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Организация заказчика:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I7:S7');
                        $sheet->cell(
                            'I7',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getOrganization()->getName());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A9:G9');
                        $sheet->cell(
                            'A9',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Телефон заказчика:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I9:S9');
                        $sheet->cell(
                            'I9',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getAllPhonesOnNativeFormat());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A11:G11');
                        $sheet->cell(
                            'A11',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Адрес заказчика:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I11:S11');
                        $sheet->cell(
                            'I11',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getAddress());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A13:G13');
                        $sheet->cell(
                            'A13',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Наименование ТИ:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I13:S13');
                        $sheet->cell(
                            'I13',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getFullName());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A15:G15');
                        $sheet->cell(
                            'A15',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('S/N ТИ:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I15:S15');
                        $sheet->cell(
                            'I15',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('S/N '.$currentRepair->getHashCode());
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A17:G17');
                        $sheet->getStyle('A17')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A17',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Описание неисправности (со слов заказчика):');
                                $cell->setValignment('top');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I17:S17');
                        $sheet->getStyle('I17')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'I17',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getDefect());
                                $cell->setAlignment('left');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A19:G19');
                        $sheet->cell(
                            'A19',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Комплектация ТИ:');
                                $cell->setValignment('top');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I19:S19');
                        $sheet->getStyle('I19')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'I19',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getSet());
                                $cell->setAlignment('left');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A21:G21');
                        $sheet->cell(
                            'A21',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Внешний осмотр:');
                                $cell->setValignment('top');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I21:S21');
                        $sheet->getStyle('I21')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'I21',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getAppearance());
                                $cell->setAlignment('left');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'top' => array(
                                            'style' => 'thin',
                                        ),
                                        'right' => array(
                                            'style' => 'thin',
                                        ),
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                        'left' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A23:G23');
                        $sheet->cell(
                            'A23',
                            function ($cell) use ($orgInfo) {
                                $cell->setValue('Принял в ремонт:');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                            }
                        );

                        $sheet->mergeCells('I23:M23');
                        $sheet->cell(
                            'I23',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getWorker()->getShortName());
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('O23:S23');
                        $sheet->cell(
                            'O23',
                            function ($cell) use ($currentRepair) {
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('I24:M24');
                        $sheet->cell(
                            'I24',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('Ф.И.О.');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('O24:S24');
                        $sheet->cell(
                            'O24',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('подпись');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('A26:S26');
                        $sheet->cell(
                            'A26',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('Правила оказания услуг по ремонту и техническому обслуживанию');
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('A27:S27');
                        $sheet->getStyle('A27')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A27',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '1. Степень интеграции компонентов, используемых в ноутбуках и ПК, очень высока (далее - техническое изделие, ТИ), поэтому незначительное повреждение любого из узлов может вызвать тотальный выход из строя. Исходя из этого, сервисный центр (далее - СЦ) не несёт ответственность за возможные ухудшения работы ТИ и/или его последующего выхода из строя (во время и/или после ремонтных работ).'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A28:S28');
                        $sheet->getStyle('A28')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A28',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '2. Ремонт производится только в отношении неисправностей, указанных в квитанции о приеме в ремонт со слов заказчика.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A29:S29');
                        $sheet->getStyle('A29')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A29',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '3. Принимаемое ТИ считается полностью или частично неработоспособным. ТИ принимается в ремонт в собранном и укомплектованном виде (отсутствовать могут блоки питания и аккумуляторные батареи), в противном случает СЦ не несёт ответственности за комплектацию сданного ТИ.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A30:S30');
                        $sheet->getStyle('A30')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A30',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '4. СЦ не несёт ответственности за дефекты, обнаруженные в процессе диагностики и ремонта, но неизвестные Заказчику или не заявленные Заказчиком выявленные дефекты устраняются за дополнительную плату с согласия Заказчика.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A31:S31');
                        $sheet->getStyle('A31')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A31',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '5. Срок диагностики от 2 до 14 дней. Сведение о ходе диагностики и ремонта можно получить в рабочее время СЦ (09:00-18:00) не ранее, чем через 2 дня с момента поступления ТИ к исполнителю, если иное не оговорено при приеме. Диагностика выполняется бесплатно в случае дальнейшего проведения ремонта.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A32:S32');
                        $sheet->getStyle('A32')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A32',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '6. При ремонте АКБ и БП возможно ухудшение состояния корпуса, так как многие из них неразборные.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A33:S33');
                        $sheet->getStyle('A33')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A33',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '7. Ориентировочная стоимость ремонта ТИ согласовывается с заказчиком при приеме ТИ в ремонт, а также после диагностики (в случае её превышения).'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A34:S34');
                        $sheet->getStyle('A34')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A34',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '8. Время ремонта 3-180 дней с момента согласования условий, при наличии необходимых комплектующих. Срочным считается ремонт, выполненный в течении 48 часов (тарификация при срочном ремонте производится с 50% надбавкой).'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A35:S35');
                        $sheet->getStyle('A35')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A35',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '9. Исполнитель не несет расходы, связанные с доставкой ТИ к месту ремонта, (даже в случае наступления гарантийных обязательств исполнителя). В случае наступления гарантийных обязательств исполнитель имеет 14 дней на их устранение.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A36:S36');
                        $sheet->getStyle('A36')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A36',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '10. Исполнитель не несет ответственности за случаи потери, утраты, порчи данных на носителях заказчика, если иное не оговорено при приёме.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A37:S37');
                        $sheet->getStyle('A37')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A37',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '11. Исполнитель несёт ответственность за сохранность ТИ только в течении 3 месяцев с момента объявления о завершении работ заказчику. В случае отказа от ремонта ТИ после определения неисправности, Заказчик оплачивает стоимость диагностики в размере 10.00 рублей.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A38:S38');
                        $sheet->getStyle('A38')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A38',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '12. Исполнитель вправе наклеивать гарантийные "стикеры" в любом месте ТИ, не мешающие его эксплуатации.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A39:S39');
                        $sheet->getStyle('A39')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A39',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('13. Исполнитель вправе привлечь для ремонта сторонние организации.');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A40:S40');
                        $sheet->getStyle('A38')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A40',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '14. ТИ выдается только по предоставлению квитанции о приёме в ремонт. В случает утери квитанции, ТИ выдается по заявлению при предъявлении документа, удостоверяющего личность Заказчика.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A41:S41');
                        $sheet->getStyle('A41')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A41',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '15. Оборудование выдается не ранее, чем через 2 рабочих дня с момента оповещения Заказчика о невозможности выполнения ремонта или с письменного заявления Заказчика в СЦ об отказе ремонтировать ТИ.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A42:S42');
                        $sheet->getStyle('A40')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A42',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    '16. Все вопросы, по которым не было достигнуто соглашения сторон, решаются в рамках законодательства Республики Беларусь.'
                                );
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A43:S43');
                        $sheet->getStyle('A41')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A43',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('17. СЦ в праве отказаться от ремонта без разъяснения причин.');
                                $cell->setAlignment('left');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(5);
                            }
                        );

                        $sheet->mergeCells('A45:I45');
                        $sheet->getStyle('A45')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'A45',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('ТИ в ремонт сдал, с правилами ремонта ознакомлен и согласен.');
                                $cell->setAlignment('left');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                                $cell->setFontWeight('bold');
                            }
                        );

                        $sheet->mergeCells('K45:S45');
                        $sheet->getStyle('K45')->getAlignment()->setWrapText(true);
                        $sheet->cell(
                            'K45',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue(
                                    'ТИ из ремонта принял. Претензии к качетсву, cрокам и объему выполненных работ не имею.'
                                );
                                $cell->setAlignment('left');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                                $cell->setFontWeight('bold');
                            }
                        );

                        $sheet->mergeCells('A47:D47');
                        $sheet->cell(
                            'A47',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getShortName());
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('F47:I47');
                        $sheet->cell(
                            'F47',
                            function ($cell) use ($currentRepair) {
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('K47:N47');
                        $sheet->cell(
                            'K47',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue($currentRepair->getClient()->getShortName());
                                $cell->setAlignment('center');
                                $cell->setFontFamily('Verdana');
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('P47:S47');
                        $sheet->cell(
                            'P47',
                            function ($cell) use ($currentRepair) {
                                $cell->setBorder(
                                    array(
                                        'bottom' => array(
                                            'style' => 'thin',
                                        ),
                                    )
                                );
                            }
                        );

                        $sheet->mergeCells('A48:D48');
                        $sheet->cell(
                            'A48',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('Ф.И.О');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('F48:I48');
                        $sheet->cell(
                            'F48',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('подпись');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('K48:N48');
                        $sheet->cell(
                            'K48',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('Ф.И.О');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                        $sheet->mergeCells('P48:S48');
                        $sheet->cell(
                            'P48',
                            function ($cell) use ($currentRepair) {
                                $cell->setValue('подпись');
                                $cell->setAlignment('center');
                                $cell->setValignment('top');
                                $cell->setFontFamily('Verdana');
                                $cell->setFontSize(6);
                            }
                        );

                    }
                );

            }
        )->download('xls');

    }

    /**
     * @param $fileName
     * @param array $listNames
     * @param array Repair[] $repairsList
     */
    public function repairStatistics($fileName, $listNames, $repairsList)
    {

        Excel::create(
            $fileName,
            function ($excel) use ($fileName, $listNames, $repairsList) {

                for ($iList = 0; $iList < count($listNames); $iList++) {
                    $listName = $listNames[$iList];
                    $repairs = $repairsList[$iList];
                    $excel->sheet(
                        $listName,
                        function ($sheet) use ($repairs, $iList) {

                            $sheet->setFontSize(10);
                            $sheet->setWidth([
                                'A' => 15,
                                'B' => 45,
                                'C' => 45,
                                'D' => 45,
                                'E' => 45,
                            ]);

                            $sheet->setPageMargin(
                                array(
                                    1.00,
                                    0.70,
                                    0.76,
                                    0.70,
                                )
                            );

                            $sheet->cell(
                                'A1',
                                function ($cell) {
                                    $cell->setValue('Квитанция');
                                    $cell->setAlignment('center');
                                    $cell->setFontWeight('bold');
                                    $cell->setBorder(
                                        array(
                                            'bottom' => array(
                                                'style' => 'thin',
                                            ),
                                        )
                                    );
                                }
                            );

                            $sheet->cell(
                                'B1',
                                function ($cell) {
                                    $cell->setValue('Техника');
                                    $cell->setAlignment('center');
                                    $cell->setFontWeight('bold');
                                    $cell->setBorder(
                                        array(
                                            'bottom' => array(
                                                'style' => 'thin',
                                            ),
                                        )
                                    );
                                }
                            );

                            $sheet->cell(
                                'C1',
                                function ($cell) {
                                    $cell->setValue('Неисправность');
                                    $cell->setAlignment('center');
                                    $cell->setFontWeight('bold');
                                    $cell->setBorder(
                                        array(
                                            'bottom' => array(
                                                'style' => 'thin',
                                            ),
                                        )
                                    );
                                }
                            );

                            $sheet->cell(
                                'D1',
                                function ($cell) {
                                    $cell->setValue('Клиент');
                                    $cell->setAlignment('center');
                                    $cell->setFontWeight('bold');
                                    $cell->setBorder(
                                        array(
                                            'bottom' => array(
                                                'style' => 'thin',
                                            ),
                                        )
                                    );
                                }
                            );

                            $sheet->cell(
                                'E1',
                                function ($cell) {
                                    $cell->setValue('Телефон');
                                    $cell->setAlignment('center');
                                    $cell->setFontWeight('bold');
                                    $cell->setBorder(
                                        array(
                                            'bottom' => array(
                                                'style' => 'thin',
                                            ),
                                        )
                                    );
                                }
                            );

                            for ($iRepair = 0; $iRepair < count($repairs); $iRepair++) {
                                /**
                                 * @var Repair $repair
                                 */
                                $repair = $repairs[$iRepair];

                                $sheet->cell(
                                    'A'.($iRepair + 2),
                                    function ($cell) use ($repair) {
                                        $cell->setValue($repair->getReceiptNumber());
                                    }
                                );

                                $sheet->cell(
                                    'B'.($iRepair + 2),
                                    function ($cell) use ($repair) {
                                        $cell->setValue($repair->getFullName());
                                    }
                                );

                                $sheet->cell(
                                    'C'.($iRepair + 2),
                                    function ($cell) use ($repair) {
                                        $cell->setValue($repair->getDefect());
                                    }
                                );

                                $sheet->cell(
                                    'D'.($iRepair + 2),
                                    function ($cell) use ($repair) {
                                        $cell->setValue($repair->getClient()->getFullName());
                                    }
                                );

                                $sheet->cell(
                                    'E'.($iRepair + 2),
                                    function ($cell) use ($repair) {
                                        $cell->setValue($repair->getClient()->getAllPhonesOnNativeFormat());
                                    }
                                );
                            }
                        }
                    );
                }
            }
        )->download('xls');
    }
}