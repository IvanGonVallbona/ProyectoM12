import { TestBed } from '@angular/core/testing';

import { DadesPersonatgesService } from './dades-personatges.service';

describe('DadesPersonatgesService', () => {
  let service: DadesPersonatgesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesPersonatgesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
