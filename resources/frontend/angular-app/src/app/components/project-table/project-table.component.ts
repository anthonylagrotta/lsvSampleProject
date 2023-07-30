import { Component, OnInit } from '@angular/core';
import { ProjectService } from '../../services/project.service';
import { MatTableDataSource } from '@angular/material/table';
import { DataSource } from '@angular/cdk/table';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { TaskService } from 'src/app/services/task.service';

export interface ProjectTable {
  name: string;
  id: number;
}

@Component({
  selector: 'project-table',
  styleUrls: ['project-table.component.scss'],
  templateUrl: './project-table.component.html',
})

export class ProjectTableComponent implements OnInit {

  displayedColumns: string[];
  dataSource: any;

  constructor(
    private projectService: ProjectService,
    private userService: UserService,
    private taskService: TaskService,
    private router: Router
  ) {
    this.displayedColumns = ['project','members','estimatedHours'];
    this.dataSource = null;
  }

  ngOnInit() {
    // Do anything for when the component loads in here
    this.getProjects();
  }

  getProjects() {
    this.projectService.getProjects().subscribe((response) => {

      console.log(response);
      this.dataSource = response;
      

    }, (error) => {

      console.error(error);

    });

  }

  goToUserProjects(userID: number){
    this.router.navigate(['user-table', userID])
  }

  goToProject(id: number) {
    this.router.navigate(['project', id]);
  }
}