import { NgModule,OnInit } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { MatTableModule } from '@angular/material/table';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { ProjectTableComponent } from './components/project-table/project-table.component';
import { UserTableComponent } from './components/user-table/user-table.component';
import { ProjectComponent } from './components/project/project.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: 'project-table', component: ProjectTableComponent },
  { path: '', redirectTo: '/project-table', pathMatch: 'full' }, // Redirect to project-table when the app starts
];

@NgModule({
  declarations: [
    AppComponent,
    ProjectTableComponent,
    UserTableComponent,
    ProjectComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    MatTableModule,
    RouterModule.forRoot(routes)
  ],
  providers: [],
  bootstrap: [AppComponent]
})

export class AppModule {
  
 }
