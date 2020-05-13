const gulp = require('gulp');
const zip = require('gulp-zip');
const { series,parallel } = require('gulp');
const del  = require('del');
const rename = require('gulp-rename');

function compressPackage() {
	return gulp.src([
		'../booking-core/**',
	])
		.pipe(zip('booking-core.zip'))
		.pipe(gulp.dest('../builds/'));

}
function copyPackage() {
	del('../builds/booking-core/*/**',{force:true});

	return gulp.src([
		'**',
		'*/.*',
		'!.env',
		'!node_modules/**',
		'!storage/installed',
		'!public/storage/**',
	])
		.pipe(gulp.dest('../builds/booking-core'));
}
function makeEnv() {
	return gulp.src([
		'.env.example',
	])
		.pipe(rename('.env'))
		.pipe(gulp.dest('../builds/booking-core'));
}

function backend(cb) {
	cb();
}
function frontend(cb) {
	cb();
}

exports.default = series(parallel(backend,frontend),copyPackage,makeEnv);
