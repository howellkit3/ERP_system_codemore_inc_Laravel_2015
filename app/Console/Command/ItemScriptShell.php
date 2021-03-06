<?php 

class ItemScriptShell extends Shell
{

    function extract_numbers($string)
    {
        preg_match_all('/([\d]+)/', $string, $match);

        return $match[0];
    }

    public function main()
    {

    	$items = $this->loadModel('WareHouse.Item');

        $Item = ClassRegistry::init('Item');

        $GeneralItem = ClassRegistry::init('GeneralItem');

        $CorrugatedPaper = ClassRegistry::init('CorrugatedPaper');  

        $conditions = array(); //array('Event.status != deleted'); 

    	$items = $this->Item->find('all',array(
                'conditions' => $conditions,
                //'limit' => 20,
                'group' => 'Item.id'
        )); 

           //  pr($items); exit();
        //save
        $saveData = array();

        $count = 1;
        
        foreach ($items as $key => $item) {
            $saveData['id'] = '';       
            $saveData['uuid'] = time();
            $saveData['name'] = str_replace(';','',$item['Item']['name']);

            $saveData['manufacturer_id'] = $item['Item']['supplier'];

            switch ($item['Item']['category_type_id']) {
         
                case '2':
                $saveData['category_id'] = 48;
                case '1':
                $saveData['category_id'] = 48;
                $saveData['type_id'] = 103;
                default:
                
                $saveData['category_id'] = 35;

                break;
            }

            $saveData['created_by'] = $item['Item']['created_by'];
            $saveData['modified_by'] = $item['Item']['modified_by'];

            $saveData['width'] = $item['Item']['width'];
            $saveData['length'] = $item['Item']['length'];

            //measurements
            $saveData['measure']  = '';
            $measures = array('For');

            if (!empty( $item['Item']['description'])) {

                    $checkInt = $this->extract_numbers($item['Item']['description']);
                
                    if(!empty($checkInt) && count($checkInt) > 0) {
                         $saveData['measure'] = $item['Item']['description'];
                    }
            }

            $saveData['modified'] = $item['Item']['length'];
            $saveData['created'] = $item['Item']['width'];

           // // exit();
           switch ($item['Item']['item_group']) {

                case 'CorrugatedPaper':
                    $model = $CorrugatedPaper;
                    $save = 'Corrugated Paper';
                break;
                default:
                    $model =  $GeneralItem;
                    $save = 'General Item';
                break;
            }

            // $model =  $GeneralItem;

            $saveData['from_warehouse'] = '1';
      
             
            if( $model->save($saveData) ) {
           // if($saveData) {
                $this->out('#id '.$item['Item']['id'].' Item '. $item['Item']['name'].' has been saved to '.$save);

            } else  {

                 $this->out('There\'s an error saving. id '.$item['Item']['id']);

            }

            $this->out($count);

            $count++;
        }


        

    //     foreach ($Attendance as $key => $attnd) {
				//  $userData['id'] = $attnd['Attendance']['id'];

				// $userData['out'] = '';

				// if ($this->Attendance->save($userData)) {

				// 	$this->out('Successfully saved');

				// } else {

				// 	$this->out('There\'s an error saving the data');

				// }
    //     }

       

      
    }
}