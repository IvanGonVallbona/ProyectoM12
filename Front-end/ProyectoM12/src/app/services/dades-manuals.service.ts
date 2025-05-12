import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IManual } from '../interfaces/imanual';

@Injectable({
  providedIn: 'root'
})
export class DadesManualsService {

  constructor(private _http: HttpClient) { }

  listManuals(): Observable<HttpResponse<IManual[]>> {
    return this._http.get<IManual[]>('/api/manuals', { observe: 'response' });
  }

  newManual(dada: any): Observable<HttpResponse<IManual>> {
    return this._http.post<IManual>('/api/manual', dada, { observe: 'response' });
  }

  getManual(id: any): Observable<HttpResponse<IManual>> {
    return this._http.get<IManual>(`api/manual/${id}`, { observe: 'response' });
  }

  editManual(id: any, dada: any): Observable<HttpResponse<IManual>> {
    return this._http.put<IManual>(`api/manual/${id}`, dada, { observe: 'response' });
  }

  deleteManual(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/manual/${id}`, { observe: 'response' });
  }
}
