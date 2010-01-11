<?php

class Applicant
{
	private $id;
	private $status = STATUS_CREATED;
	
	/**
	 * 
	 */
	public function transition_to_state($newState, $force = false)
	{
		if (!$force)
		{
			// The list of state transitions that are valid.
			$transitions = array(
				STATUS_CREATED     =>   array(STATUS_DRAFT),
				STATUS_DRAFT       =>   array(STATUS_SUBMITTED),
				STATUS_SUBMITTED   =>   array(STATUS_ACCEPTED, STATUS_REJECTED)				
			);
			
			if (!array_key_exists($this->status, $transitions))
			{
				throw new RuntimeException('Unknown starting state ' . $status);
			}
			
			if (array_search($newState, $transitions[$this->status]) === false)
			{
				throw new RuntimeException('Invalid state transition: ' . $this->status . '->' . $newState);
			}
		}
		
		// TODO: persist new status to DB here
		
		$this->status = $newState;
	}
	
	public function trigger_emails()
	{
	}
}

?>