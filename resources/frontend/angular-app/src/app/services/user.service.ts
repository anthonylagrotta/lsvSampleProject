import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  getProjects(userID: number): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/users/${userID}`);
  }

  addProject(post: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/users`, post);
  }

  updateProject(id: number, post: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/users/${id}`, post);
  }

  deleteProject(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/users/${id}`);
  }
}
