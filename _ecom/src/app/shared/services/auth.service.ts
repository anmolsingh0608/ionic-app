import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { login } from '../models/login.model';
import { Token } from '../models/token.model';
import { Response } from '../models/response';
import { UserRole } from '../models/user-role.model';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  apiUrl = environment.apiUrl;

  loginType: UserRole;

  constructor(private http: HttpClient) { }

  isLoggedIn() {
    const token = localStorage.getItem('token');
    return !!token;
  }

  login(data: login):Observable<Response<Token>> {
    return this.http.post<Response<Token>>(`${this.apiUrl}/login`, data);
  }

  setData(data: Token) {
    localStorage.setItem('token', data.token.plainTextToken);
  }

  logout(): Observable<Response<null>> {
    return this.http.post<Response<null>>(`${this.apiUrl}/logout`, {});
  }

  clearToken() {
    localStorage.clear();
  }

  getToken() {
    const token = localStorage.getItem('token');
    return token;
  }
}
