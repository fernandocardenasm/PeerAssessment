<?php

session_start();
require_once('../../funciones.php');
require_once ('../../PHPExcel_1.8.0_doc/Classes/PHPExcel.php');
require_once ('../../PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
conectar();

$respuesta['exito']="";
date_default_timezone_set('America/Bogota');

if(empty($_SESSION['user'])||empty($_SESSION['logged'])||empty($_SESSION['class'])){
    echo '<script>window.location="../../index.html"</script>';
}
else{
    if($_SESSION['class']!="profesor"){
        echo '<script>window.location="../../index.html"</script>';
    }
    else{
        if(empty($_SESSION['curso_seleccionado'])){
            echo '<script>window.location="../Front/inicio_profesor.php"</script>';
        }
        else{
            
            $id_curso = $_SESSION['curso_seleccionado'];
            $id_assessment=$_POST['no_excel'];
            $cadena="";
                //Obter el # de los criterios de la rubrica del semestre
            
                $sql = "SELECT COUNT(c.numero) "
                    . "FROM criterioestandar AS c "
                    . "INNER JOIN semestre AS s ON s.idRubrica=c.idRubricaEstandar "
                    . "INNER JOIN cursotbl AS ctbl ON ctbl.idSemestre=s.id "
                    . "INNER JOIN assessment AS a ON a.idCurso=ctbl.id "
                    . "WHERE a.id=$id_assessment";

                $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                
                $respuesta['n_criterios']=mysql_result($result,0,0);
                
                if($respuesta['n_criterios']>0){
                
                    $sql = "SELECT e.codigo,e.nombre,e.apellidos,er.numeroEquipo "
                        . "FROM assessment AS a "
                        . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
                        . "INNER JOIN estudiantetbl AS e ON e.codigo=er.codigoEstudiante "
                        . "WHERE a.id=$id_assessment AND (er.estadoEntrega='COMPLETED' OR er.estadoEntrega='INCOMPLETED') "
                        . "ORDER BY er.numeroEquipo,e.codigo";

                    $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                    
                    $respuesta['n_estudiantes']=mysql_num_rows($result);
                    
                    if($respuesta['n_estudiantes']>0){
                    
                        $i=0;
                        while($row = mysql_fetch_array($result)){
                            $estudiantes['codigo'][$i]=$row['codigo'];
                            $estudiantes['nombre'][$i]=$row['nombre'];
                            $estudiantes['equipo'][$i]=$row['numeroEquipo'];
                            $estudiantes['apellidos'][$i]=$row['apellidos'];
                            $i++;

                            //$cadena=$cadena.'#Equipo: '.$row['numeroEquipo'].' Nombre: '.$row['nombre'].' Codigo: '.$row['codigo'];
                        }
                        //$respuesta['cadena']=$cadena;
                        
                        //$i<$respuesta['n_estudiantes']
                        
                        //$i<$respuesta['n_estudiantes']
                        
                        $objPHPExcel = new PHPExcel();
                            
                            
                            // Se asignan las propiedades del libro
                        $objPHPExcel->getProperties()->setCreator("PeerAssessment") // Nombre del autor
                                    ->setLastModifiedBy("PeerAssessment") //Ultimo usuario que lo modificó
                                    ->setTitle("Reporte Excel con PHP y MySQL") // Titulo
                                    ->setSubject("Reporte Excel con PHP y MySQL") //Asunto
                                    ->setDescription("Reporte de alumnos") //Descripción
                                    ->setKeywords("reporte alumnos assessment") //Etiquetas
                                    ->setCategory("Reporte excel"); //Categorias
                                
                        $tituloReporte = "Evaluación entre pares de alumnos";
                        
                        $tituloReporte2 = "Las celdas en azul claro indican autoevaluación";
                         
                                // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->mergeCells('B1:F1');
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->mergeCells('H1:L1');
                        
                                //Generar letras del abecedario
                        $j=0;
                        for ($i=65;$i<=90;$i++) {
                            $letra[$j]=chr($i);
                            $j++;
                        }
                        
                        
                        //Obtener equipo con maximo numero de miembros de equipo
                        $sql = "SELECT er.numeroEquipo,COUNT(*) AS num_equipo "
                            . "FROM entregasremitentes AS er "
                            . "INNER JOIN assessment AS a ON a.id=er.idAssessment "
                            . "WHERE a.id=$id_assessment "
                            . "GROUP BY er.numeroEquipo "
                            . "ORDER BY num_equipo DESC,er.numeroEquipo DESC";
                        
                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                       
                        $num_mayor_equipo=mysql_result($result,0,1);
                        //Obtener abreviaturas
                        
                        $sql = "SELECT er.numeroEquipo,COUNT(*) AS num_equipo "
                            . "FROM entregasremitentes AS er "
                            . "INNER JOIN assessment AS a ON a.id=er.idAssessment "
                            . "WHERE a.id=$id_assessment "
                            . "GROUP BY er.numeroEquipo "
                            . "ORDER BY num_equipo ASC,er.numeroEquipo ASC";
                        
                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                        
                        $t=0;
                        
                        while ($row = mysql_fetch_array($result)){
                            $equipo[$t]=mysql_result($result,$t,0);
                            $equipo['num_int'][$equipo[$t]]=mysql_result($result,$t,1);
                            $t++;
                        }
                        
                        $num_total_equipos=$t;
                        
                        $sql = "SELECT c.abreviatura,c.numero "
                            . "FROM criterioestandar AS c "
                            . "INNER JOIN semestre AS s ON s.idRubrica=c.idRubricaEstandar "
                            . "INNER JOIN cursotbl AS ctbl ON ctbl.idSemestre=s.id "
                            . "INNER JOIN assessment AS a ON a.idCurso=ctbl.id "
                            . "WHERE a.id=$id_assessment "
                            . "ORDER BY c.numero";

                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                        $i=0;
                        while($row = mysql_fetch_array($result)){
                            $abreviaturas[$i]=$row['abreviatura'];
                            $i++;
                        }
                        
                        
                                // Se agregan los titulos del reporte
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('B1',$tituloReporte); // Titulo del reporte;
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('H1',$tituloReporte2); // Titulo del reporte;
                        
                        $titulosColumnas = array('GRUPO','NOMBRE');
                        
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('B3',  $titulosColumnas[0])
                                    ->setCellValue('C3',  $titulosColumnas[1]);
                        
                        
                            
                        $cont=3;
                        $cad_letra="";
                        $cont_crit=0;
                        
                        $m=$respuesta['n_criterios']*$num_mayor_equipo;
                        $num_letra_mayor = $m;
                        
                        for($i=3;$i<$m+3;$i++){
                            
                            if($cont_crit==$respuesta['n_criterios']){
                                $cont_crit=0;
                            }
                            
                            if($i<26){
                                $cad_letra = $letra[$cont];
                                if($i==25){
                                    $cont=-1;
                                }
                            }
                            else if($i>=26 && $i<52){
                                $cad_letra = 'A'.$letra[$cont];
                                if($i==51){
                                    $cont=-1;
                                }
                                
                            }
                            else if($i>=52&&$i<78){
                                $cad_letra = 'B'.$letra[$cont];
                                if($i==77){
                                    $cont=-1;
                                }
                            }
                            else if($i>78&&$i<104){
                                $cad_letra = 'C'.$letra[$cont];
                                if($i==103){
                                    $cont=-1;
                                }
                            }
                            
                            $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue($cad_letra.'3',  $abreviaturas[$cont_crit]);
                            $cont++;
                            $cont_crit++;
                        }
                        
                        $start_fila = 4; //Numero de fila donde se va a comenzar a rellenar
                        $cad_letra_aux='D';
                        
                        for($i=0;$i<$respuesta['n_estudiantes'];$i++){
                            
                            $codigo_est=$estudiantes['codigo'][$i];
                            
                            $sql = "SELECT DISTINCT e.nombre,e.codigo,r.calificacion,c.abreviatura,c.numero,r.codigoDestinatario "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
                            . "INNER JOIN estudiantetbl AS e ON e.codigo=er.codigoEstudiante "
                            . "INNER JOIN resultados AS r ON r.idEntregaRemitente=er.id "
                            . "INNER JOIN criterioestandar AS c ON r.numeroCriterio=c.numero "
                            . "WHERE a.id=$id_assessment AND e.codigo=$codigo_est "
                            . "ORDER BY r.codigoDestinatario,c.numero";

                            $result = mysql_query($sql) or die("La consulta no se pudo realizar");
                            $num_destinatarios=mysql_num_rows($result)/$respuesta['n_criterios'];
                            
                            
                            $j=0;
                            $k=0;
                            while($row = mysql_fetch_array($result)){
                                $cadena = $cadena.'Destinatario: '.$row["codigoDestinatario"].' Calificacion: '.$row['calificacion']
                                        .' Abreviatura '.$row['abreviatura'].' Evaluador: '.$estudiantes['nombre'][$i];
                                
                                $array_cod_des[$j]=$row['codigoDestinatario'];
                                
                                $calificaciones[$row['codigoDestinatario']][$k]=$row['calificacion'];
                                
                                $k++;
                                
                                if($k==$respuesta['n_criterios']){
                                    $j++;
                                    $k=0;
                                }
                                
                                //Generar reporte excel

                            }
                            
                            $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('B'.$start_fila,  $estudiantes['equipo'][$i])
                                    ->setCellValue('C'.$start_fila, $estudiantes['apellidos'][$i].' '.$estudiantes['nombre'][$i]);
                             
                            
                            $cont=3;
                            $cad_letra="";
                            $cont_crit=0;
                            
                            $m=$num_destinatarios*$respuesta['n_criterios'];
                            
                            $j=0;
                            
                            for($p=3;$p<$m+3;$p++){
                                
                                
                                if($cont_crit==$respuesta['n_criterios']){
                                    $cont_crit=0;
                                    $j++;
                                }
                                
                                if($p<26){
                                    $cad_letra = $letra[$cont];
                                    if($p==25){
                                        $cont=-1;
                                    }
                                }
                                else if($p>=26 && $p<52){
                                    $cad_letra = 'A'.$letra[$cont];
                                    if($p==51){
                                        $cont=-1;
                                    }

                                }
                                else if($p>=52&&$p<78){
                                    $cad_letra = 'B'.$letra[$cont];
                                    if($p==77){
                                        $cont=-1;
                                    }
                                }
                                else if($p>78&&$p<104){
                                    $cad_letra = 'C'.$letra[$cont];
                                    if($p==103){
                                        $cont=-1;
                                    }
                                }

                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue($cad_letra.$start_fila,  $calificaciones[$array_cod_des[$j]][$cont_crit]);
                                
                                $cont++;
                                $cont_crit++;
                                
                                
                                
                                if($cad_letra!=""){
                                    $cad_letra_aux = $cad_letra;
                                }
                                
                            }

                            $start_fila++;

                            
                            //$respuesta['cadena']=$cadena;
                            
                        }
                        
                        
                        //Estilos excel
                        
                        $estiloTituloReporte = array(
                            'font' => array(
                                'name'      => 'Verdana',
                                'bold'      => true,
                                'italic'    => false,
                                'strike'    => false,
                                'size' =>16,
                                'color'     => array(
                                    'rgb' => 'FFFFFF'
                                )
                            ),
                            'fill' => array(
                                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array(
                                    'argb' => '236B8E')
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_NONE
                                )
                            ),
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                'rotation' => 0,
                                'wrap' => TRUE
                            )
                        );
                        
                        $estiloTituloReporte2 = array(
                            'font' => array(
                                'name'      => 'Verdana',
                                'bold'      => true,
                                'italic'    => false,
                                'strike'    => false,
                                'size' =>8,
                                'color'     => array(
                                    'rgb' => 'FFFFFF'
                                )
                            ),
                            'fill' => array(
                                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array(
                                    'argb' => '236B8E')
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_NONE
                                )
                            ),
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                'rotation' => 0,
                                'wrap' => TRUE
                            )
                        );
 
                        $estiloTituloColumnas = array(
                            'font' => array(
                                'name'  => 'Arial',
                                'bold'  => true,
                                'color' => array(
                                    'rgb' => 'FFFFFF'
                                )
                            ),
                            'fill' => array(
                                'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                                'startcolor' => array(
                                    'rgb' => '236B8E'
                                ),
                                'endcolor' => array(
                                    'argb' => '236B8E'
                                )
                            ),
                            'borders' => array(
                                'top' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                                    'color' => array(
                                        'rgb' => '000000'
                                    )
                                ),
                                'bottom' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                                    'color' => array(
                                        'rgb' => '000000'
                                    )
                                )
                            ),
                            'alignment' =>  array(
                                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                'wrap'      => TRUE
                            )
                        );

                        $estiloInformacion = new PHPExcel_Style();
                        $estiloInformacion->applyFromArray( array(
                            'font' => array(
                                'name'  => 'Arial',
                                'color' => array(
                                    'rgb' => '000000'
                                )
                            ),
                            'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                    'argb' => 'FFFFFF')
                            ),
                            'borders' => array(
                                'left' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                                'color' => array(
                                        'rgb' => '000000'
                                    )
                                )
                            )
                        ));
                        $estiloInformacion2 = new PHPExcel_Style();
                        $estiloInformacion2->applyFromArray( array(
                            'font' => array(
                                'name'  => 'Arial',
                                'color' => array(
                                    'rgb' => '000000'
                                )
                            ),
                            'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                    'argb' => 'C1D1FC')
                            ),
                            'borders' => array(
                                'left' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                                'color' => array(
                                        'rgb' => '000000'
                                    )
                                )
                            )
                        ));

                        
                        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
                        $objPHPExcel->getActiveSheet()->getStyle('H1:L1')->applyFromArray($estiloTituloReporte2);
                        
                        $num_letra_mayor=$num_letra_mayor+2;
                        
                                
                        if($num_letra_mayor<=26){
                            $cad_letra_aux= $letra[$num_letra_mayor];
                        }
                        else if($num_letra_mayor>26 && $num_letra_mayor<=52){
                            $cad_letra_aux= 'A'.$letra[$num_letra_mayor-26];
                        }
                        else if($num_letra_mayor>52&&$num_letra_mayor<=78){
                            $cad_letra_aux= 'B'.$letra[$num_letra_mayor-52];
                        }
                        else if($num_letra_mayor>78&&$num_letra_mayor<=104){
                            $cad_letra_aux= 'C'.$letra[$num_letra_mayor-78];
                        }
                        
                        $objPHPExcel->getActiveSheet()->getStyle('B3:'.$cad_letra_aux.'3')->applyFromArray($estiloTituloColumnas);
                        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B4:".$cad_letra_aux.($respuesta['n_estudiantes']+3));
                        
                        $start=4;

                        //Pintar diagonales
                        
                        
                            
                            $cad_letra="";
                            $cont_crit=0;
                            
                            
                            $j=0;
                            
                            for($p=0;$p<$num_total_equipos;$p++){
                                $cont=3;
                                for($o=3;$o<($equipo['num_int'][$equipo[$p]]*$respuesta['n_criterios'])+3;$o++){
                                    if($cont_crit==$respuesta['n_criterios']){
                                        $cont_crit=0;
                                        $start++;
                                    }
                                    
                                     if($o<26){
                                        $cad_letra = $letra[$cont];
                                        if($o==25){
                                            $cont=-1;
                                        }
                                    }
                                    else if($o>=26 && $o<52){
                                        $cad_letra = 'A'.$letra[$cont];
                                        if($o==51){
                                            $cont=-1;
                                        }

                                    }
                                    else if($o>=52&&$o<78){
                                        $cad_letra = 'B'.$letra[$cont];
                                        if($o==77){
                                            $cont=-1;
                                        }
                                    }
                                    else if($o>=78&&$o<104){
                                        $cad_letra = 'C'.$letra[$cont];
                                        if($o==103){
                                            $cont=-1;
                                        }
                                    }
                                    
                                    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion2, $cad_letra.$start);

                                    $cont++;
                                    $cont_crit++;
                                    
                                }
                            }

                        
                        
                        for($i = 'A'; $i <= 'C'; $i++){
                            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
                        }
                        
                        // Se asigna el nombre a la hoja
                        $objPHPExcel->getActiveSheet()->setTitle('Alumnos');

                        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
                        $objPHPExcel->setActiveSheetIndex(0);

                        // Inmovilizar paneles
                        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
                        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
                        
                        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                        header('Content-Disposition: attachment;filename="Reportedealumnos.xlsx"');
                        header('Cache-Control: max-age=0');

                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                        $objWriter->save('php://output');
                        exit();
                         
                        
                        //Obtener los resultados dado por los estudiantes a sus otros compañeros

                        /*$sql = "SELECT DISTINCT e.nombre,er.numeroEquipo,r.calificacion,c.abreviatura,c.numero "
                            . "FROM assessment AS a "
                            . "INNER JOIN entregasremitentes AS er ON er.idAssessment=a.id "
                            . "INNER JOIN estudiantetbl AS e ON e.codigo=er.codigoEstudiante "
                            . "INNER JOIN resultados AS r ON r.idEntregaRemitente=er.id "
                            . "INNER JOIN criterioestandar AS c ON r.numeroCriterio=c.numero "
                            . "WHERE a.id=$id_assessment "
                            . "ORDER BY er.numeroEquipo,e.nombre,c.numero";

                        $result = mysql_query($sql) or die("La consulta no se pudo realizar");

                        if(mysql_num_rows($result)>0){
                            $respuesta['n_estudiantes']=mysql_num_rows($result);
                            $respuesta['exito']="exito";

                            $cadena="";

                            while($row = mysql_fetch_array($result)){
                                $cadena=$cadena.'Nombre: '.$row['nombre']
                                        .'#Equipo: '.$row['numeroEquipo']
                                        .'Calificacion: '.$row['calificacion']
                                        .'Abreviatura: '.$row['abreviatura']."\n";
                            }
                            $respuesta['cadena']=$cadena;


                        }
                        else{
                            $respuesta['exito']="vacio";
                        }
                         * 
                         */
                        $respuesta['exito']="exito";
                        $respuesta['cadena']=$cadena;
                    }
                    else{
                        $respuesta['exito']="repuestas_vacio";
                    }
                }
                else{
                    $respuesta['exito']="criterio_vacio";
                }
        
        }
    }
}

mysql_close();
?>
