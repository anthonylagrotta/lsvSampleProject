import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProjectService } from './services/project.service';
import { ProjectComponent } from './components/project/project.component';
import { ProjectTableComponent } from './components/project-table/project-table.component';
import { UserTableComponent } from './components/user-table/user-table.component';

const routes: Routes = [
  {path: 'project-table', component: ProjectTableComponent},
  {path: 'project/:id', component: ProjectComponent},
  {path: 'user-table/:userID', component: UserTableComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
