export interface Task {
  id?: number;
  name: string;
  assignedTo: number;
  projectID: number;
  estimatedHours: number;
}