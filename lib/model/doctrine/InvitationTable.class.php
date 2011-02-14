<?php


class InvitationTable extends Doctrine_Table
{
	/**
	 * Find the invitation with the email
	 *
	 * @param string $email 
	 * @return false/Invitation
	 */
	public function findInvitedByEmail($email = null)
	{
		if (!$email) {
			return false;
		}

		$invited = $this->findOneByEmail($email);
		return ($invited) ? $invited : false;
	}
}