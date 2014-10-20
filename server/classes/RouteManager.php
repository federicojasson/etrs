<?php

/*
 * TODO
 */
class RouteManager {
	
	/*
	 * TODO
	 */
	private $groupsActions;
	
	/*
	 * TODO
	 */
	public function addGroupAction($group, $action) {
		$this->groupsActions[$group][] = $action;
	}
	
	/*
	 * TODO
	 */
	public function executeRouteActions($route) {
		// Checks if the route belongs to any of the groups
		foreach ($this->groupsActions as $group => $actions) {
			if ($this->routeBelongsToGroup($route, $group)) {
				// The route belongs to the group
				
				// Executes the actions associated with the group
				$this->executeActions($actions);
				
				// There is nothing left to do
				return;
			}
		}
	}
	
	/*
	 * TODO
	 */
	private function executeActions($actions) {
		foreach ($actions as $action) {
			call_user_func($action);
		}
	}
	
	/*
	 * TODO
	 */
	private function routeBelongsToGroup($route, $group) {
		// A route belongs to a group if it's prefixed with the group's name
		return substr($route, 0, strlen($group)) === $group;
	}
	
}
