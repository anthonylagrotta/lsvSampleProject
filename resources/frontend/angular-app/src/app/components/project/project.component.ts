import { Component, OnInit } from '@angular/core';
import { ProjectService } from '../../services/project.service';
import { MatTableDataSource } from '@angular/material/table';
import { DataSource } from '@angular/cdk/table';
import { TaskService } from 'src/app/services/task.service';
import { UserService } from 'src/app/services/user.service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';


export interface Project {
  task: string;
  assignedTo: string;
  estimatedHours: number;
  userID: number;
}

@Component({
  selector: 'project',
  templateUrl: './project.component.html',
  styleUrls: ['./project.component.scss']
})

export class ProjectComponent implements OnInit {

  displayedColumns: string[];
  dataSource: any;

  constructor(
    private currentUrl: ActivatedRoute,
    private taskService: TaskService,
    private userService: UserService,
    private router: Router
  ) {
    this.displayedColumns = ['task','assignedTo','estimatedHours'];
    this.dataSource = null;
  }

  ngOnInit() {

    let id = null;
    id = this.currentUrl.snapshot.paramMap.get('id');

      if (id) {
        this.getProject(parseInt(id,10));
      } else {
        console.error("Could not get ID from URL");
      }

    // Do anything for when the component loads in here
    
  }

  getProject(id: number) {
     this.taskService.getTasks(id).subscribe((response) => {

       console.log(response);
       this.dataSource = response;


     }, (error) => {

       console.error(error);

     });

  }

  goToUserProjects(userID: number){
    this.router.navigate(['user-table', userID])
  }

  goToProjectTable(){
    this.router.navigate(['project-table'])
  }
}