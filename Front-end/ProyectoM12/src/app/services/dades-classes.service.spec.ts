import { TestBed } from '@angular/core/testing';

import { DadesClassesService } from './dades-classes.service';

describe('DadesClassesService', () => {
  let service: DadesClassesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesClassesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
