import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SkeletonAdminComponent } from './skeleton-admin.component';

describe('SkeletonAdminComponent', () => {
  let component: SkeletonAdminComponent;
  let fixture: ComponentFixture<SkeletonAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SkeletonAdminComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SkeletonAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
