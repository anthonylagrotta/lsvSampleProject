import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TaskService {

  apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  getTasks(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/tasks/${id}`);
  }

  

}
