import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IClasse } from '../interfaces/iclasse';

@Injectable({
  providedIn: 'root'
})
export class DadesClassesService {

  constructor(private _http: HttpClient) { }

  listClasses(): Observable<HttpResponse<IClasse[]>> {
    return this._http.get<IClasse[]>('/api/classes', { observe: 'response' });
  }

  newClasse(dada: any): Observable<HttpResponse<IClasse>> {
    return this._http.post<IClasse>('/api/classe', dada, { observe: 'response' });
  }

  getClasse(id: any): Observable<HttpResponse<IClasse>> {
    return this._http.get<IClasse>(`api/classe/${id}`, { observe: 'response' });
  }

  editClasse(id: any, dada: any): Observable<HttpResponse<IClasse>> {
    return this._http.put<IClasse>(`api/classe/${id}`, dada, { observe: 'response' });
  }

  deleteClasse(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/classe/${id}`, { observe: 'response' });
  }
}
