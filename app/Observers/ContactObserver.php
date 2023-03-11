<?php

	namespace App\Observers;

	use App\Models\Contact;
	use DateTime;

	class ContactObserver
	{
		/**
		 * Handle the Contact "created" event.
		 *
		 * @param Contact $contact
		 *
		 * @throws \Exception
		 */
		public function created(Contact $contact): void
		{
			// Calculate age based on date of birth
			$dateOfBirth = new DateTime($contact->date_of_birth);
			$now = new DateTime();
			$ageDiff = $now->diff($dateOfBirth);
			$age = $ageDiff->y . ' years, ' . $ageDiff->m . ' months, ' . $ageDiff->d . ' days';

			// Set age attribute on contact
			$contact->age = $age;
			$contact->saveQuietly();
		}

		/**
		 * Handle the Contact "updated" event.
		 *
		 * @throws \Exception
		 */
		public function updated(Contact $contact): void
		{
			// Check if date of birth has been changed
			if ($contact->isDirty('date_of_birth')) {
				// Calculate age based on date of birth
				$dateOfBirth = new DateTime($contact->date_of_birth);
				$now = new DateTime();
				$ageDiff = $now->diff($dateOfBirth);
				$age = $ageDiff->y . ' years, ' . $ageDiff->m . ' months, ' . $ageDiff->d . ' days';

				// Check if the age attribute has actually changed
				if ($contact->age !== $age) {
					// Set age attribute on contact
					$contact->update(['age' => $age]);
				}
			}
		}

		/**
		 * Handle the Contact "deleted" event.
		 */
		public function deleted(Contact $contact): void
		{
			//
		}

		/**
		 * Handle the Contact "restored" event.
		 */
		public function restored(Contact $contact): void
		{
			//
		}

		/**
		 * Handle the Contact "force deleted" event.
		 */
		public function forceDeleted(Contact $contact): void
		{
			//
		}
	}
