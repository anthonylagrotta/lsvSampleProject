import { Component, OnInit } from '@angular/core';
import { ProjectService } from '../../services/project.service';
import { MatTableDataSource } from '@angular/material/table';
import { DataSource } from '@angular/cdk/table';
import { UserService } from 'src/app/services/user.service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';

export interface UserTable {
  project: string;
  members: string;
  estimatedHours: number;
}

@Component({
  selector: 'user-table',
  templateUrl: './user-table.component.html',
  styleUrls: ['./user-table.component.scss']
})

export class UserTableComponent implements OnInit {

  displayedColumns: string[];
  dataSource: any;

  constructor(
    private currentUrl: ActivatedRoute,
    private projectService: ProjectService,
    private userService: UserService,
    private router: Router
  ) {
    this.displayedColumns = ['project','members','estimatedHours'];
    this.dataSource = null;
  }

  ngOnInit() {
    this.router.routeReuseStrategy.shouldReuseRoute = () => false;
    let userID = null;
    userID = this.currentUrl.snapshot.paramMap.get('userID');

      if (userID) {
        this.getUserProjects(parseInt(userID,10));
      } else {
        console.error("Could not get userID from URL");
      }
  }
  goToUserProjects(userID: number){
    this.router.navigate(['user-table', userID]);
  }

  goToProject(id: number) {
    this.router.navigate(['project', id]);
  }
  
  goToProjectTable(){
    this.router.navigate(['project-table'])
  }

  getUserProjects(userID: number) {
     this.userService.getProjects(userID).subscribe((response) => {

       console.log(response);
       this.dataSource = response;


     }, (error) => {

       console.error(error);

     });

  }
}