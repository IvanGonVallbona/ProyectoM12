import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IRegistre } from '../interfaces/iregistre';

@Injectable({
  providedIn: 'root'
})
export class DadesRegistresService {

  constructor(private _http: HttpClient) { }

  indexRegistre(): Observable<IRegistre[]> {
    return this._http.get<IRegistre[]>('/api/registres');
  }

  createRegistre(dada: any): Observable<HttpResponse<IRegistre>> {
    return this._http.post<IRegistre>('/api/registre', dada, { observe: 'response' });
  }

  getRegistre(id: any): Observable<HttpResponse<IRegistre>> {
    return this._http.get<IRegistre>(`api/registre/${id}`, { observe: 'response' });
  }

  editRegistre(id: any, dada: any): Observable<HttpResponse<IRegistre>> {
    return this._http.put<IRegistre>(`api/registre/${id}`, dada, { observe: 'response' });
  }

  destroyRegistre(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/registre/${id}`, { observe: 'response' });
  }

  getRegistresByCampanya(campanyaId: string) {
    return this._http.get<IRegistre[]>(`http://localhost:8000/api/registres/campanya/${campanyaId}`);
  }
}
