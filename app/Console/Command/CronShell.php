<?php 

class CronShell extends Shell
{
    public function main()
    {

    	$this->loadModel('HumanResource.Attendance');		

        $conditions = array('Attendance.out' => 'no-time-out'); //array('Event.status != deleted'); 

    	$Attendance = $this->Attendance->find('all',array(
                'conditions' => $conditions,
        ));

        foreach ($Attendance as $key => $attnd) {
				 $userData['id'] = $attnd['Attendance']['id'];

				$userData['out'] = '';

				if ($this->Attendance->save($userData)) {

					$this->out('Successfully saved');

				} else {

					$this->out('There\'s an error saving the data');

				}
        }

       

      
    }
}