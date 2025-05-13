import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IRaza } from '../interfaces/iraza';

@Injectable({
  providedIn: 'root'
})
export class DadesRazasService {

  constructor(private _http: HttpClient) { }

  indexRaza(): Observable<HttpResponse<IRaza[]>> {
    return this._http.get<IRaza[]>('/api/razas', { observe: 'response' });
  }

  createRaza(dada: any): Observable<HttpResponse<IRaza>> {
    return this._http.post<IRaza>('/api/raza', dada, { observe: 'response' });
  }

  getRaza(id: any): Observable<HttpResponse<IRaza>> {
    return this._http.get<IRaza>(`api/raza/${id}`, { observe: 'response' });
  }

  editRaza(id: any, dada: any): Observable<HttpResponse<IRaza>> {
    return this._http.put<IRaza>(`api/raza/${id}`, dada, { observe: 'response' });
  }

  destroyRaza(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/raza/${id}`, { observe: 'response' });
  }
}
