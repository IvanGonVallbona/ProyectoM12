import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IPersonatge } from '../interfaces/ipersonatge';

@Injectable({
  providedIn: 'root'
})
export class DadesPersonatgesService {

  constructor(private _http: HttpClient) { }

  listPersonatges(): Observable<HttpResponse<IPersonatge[]>> {
    return this._http.get<IPersonatge[]>('/api/personatges', { observe: 'response' });
  }

  newPersonatge(dada: any): Observable<HttpResponse<IPersonatge>> {
    return this._http.post<IPersonatge>('/api/personatge', dada, { observe: 'response' });
  }

  getPersonatge(id: any): Observable<HttpResponse<IPersonatge>> {
    return this._http.get<IPersonatge>(`api/personatge/${id}`, { observe: 'response' });
  }

  editPersonatge(id: any, dada: any): Observable<HttpResponse<IPersonatge>> {
    return this._http.put<IPersonatge>(`api/personatge/${id}`, dada, { observe: 'response' });
  }

  deletePersonatge(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/personatge/${id}`, { observe: 'response' });
  }
}
