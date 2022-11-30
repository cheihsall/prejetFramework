import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private client: HttpClient) { } 
  getUser(): Observable<[]>{
    return this.client.get<[]>("http://127.0.0.1:8001/api/but")
  }
}
