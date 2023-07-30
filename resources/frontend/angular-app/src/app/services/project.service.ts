import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProjectService {

  apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  getProjects(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/projects`);
  }

  getProject(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/projects/${id}`);
  }

  addProject(post: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/projects`, post);
  }

  updateProject(id: number, post: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/projects/${id}`, post);
  }

  deleteProject(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/projects/${id}`);
  }
}
