<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kajian;
use Illuminate\Support\Facades\Auth;

class KajianController extends Controller
{
  public function index()
  {
      try {
          $listKajian = Kajian::all();
          //return successful response
          return response()->json(['list_kajian' => $listKajian, 'message' => 'Get All Kajian Succesfully'], 200);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => 'Cannot Get All Kajian!'], 409);
      }
  }
  public function store(Request $request)
  {
      //validate incoming request
      $this->validate($request, [
          'nama' => 'required|string',
          'tanggal' => 'required',
          'waktu' => 'required',
          'lama' => 'required|string',
          'deskripsi' => 'required|string',
          'alamat' => 'required|string',
          'pembicara' => 'required|string',
      ]);

      try {
          $kajian = new Kajian;
          $kajian->nama = $request->input('nama');
          $kajian->tanggal = $request->input('tanggal');
          $kajian->waktu = $request->input('waktu');
          $kajian->lama = $request->input('lama');
          $kajian->deskripsi = $request->input('deskripsi');
          $kajian->alamat = $request->input('alamat');
          $kajian->pembicara = $request->input('pembicara');

          $kajian->save();

          //return successful response
          return response()->json(['kajian' => $kajian, 'message' => 'Kajian Created'], 201);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => $e], 409);
      }
  }

  public function update(Request $request, $id)
  {
      //validate incoming request
      $this->validate($request, [
          'nama' => 'required|string',
          'tanggal' => 'required',
          'waktu' => 'required',
          'lama' => 'required|string',
          'deskripsi' => 'required|string',
          'alamat' => 'required|string',
          'pembicara' => 'required|string',
      ]);

      try {
          $kajian = Kajian::where('id', $id)->first();
          $kajian->update([
            'nama' => $request->input('nama'),
            'tanggal' => $request->input('tanggal'),
            'waktu' => $request->input('waktu'),
            'lama' => $request->input('lama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'pembicara' => $request->input('pembicara'),
          ]);

          //return successful response
          return response()->json(['kajian' => $kajian, 'message' => 'Kajian Updated'], 200);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => 'Update Kajian Failed!'], 409);
      }
  }

  public function destroy($id)
  {
      try {
          Kajian::destroy($id);
          //return error message
          return response()->json(['message' => 'Kajian Deleted!'], 200);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => 'Delete Kajian Failed!'], 409);
      }
  }

  public function search($query)
  {
      try {
          $kajian = Kajian::where("nama", "LIKE","%$query%")->orWhere("deskripsi", "LIKE", "%$query%")->get();
          //return error message
          return response()->json(['list_kajian' => $kajian], 200);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => 'Search Kajian Failed!'], 409);
      }
  }

  public function show($id)
  {
      try {
          $kajian = Kajian::findOrFail($id)->first();
          //return error message
          return response()->json(['kajian' => $kajian], 200);
      } catch (\Exception $e) {
          //return error message
          return response()->json(['message' => 'Get Kajian Failed!'], 409);
      }
  }
}
