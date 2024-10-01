import { InertiaLink } from '@inertiajs/inertia-react';
import React from 'react';
import { PageProps, User } from '../../types'; // Suponiendo que los types están en 'types'

interface UsersIndexProps extends PageProps {
    users: {
        data: User[]; // Lista de usuarios
        links: Array<{
            url: string | null; // URL de la página
            label: string; // Etiqueta del enlace (como "Siguiente", "Anterior")
            active: boolean; // Si el enlace es la página actual
        }>;
    };
}

const Index: React.FC<UsersIndexProps> = ({ auth, users }) => {
    return (
        <div className="container mx-auto px-4">
            <h1 className="mb-4 text-2xl font-bold">Lista de Usuarios</h1>
            <InertiaLink
                href="/users/create"
                className="rounded bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600"
            >
                Crear Usuario
            </InertiaLink>

            <table className="mt-4 min-w-full border border-gray-200 bg-white shadow-md">
                <thead>
                    <tr className="bg-gray-200 text-sm uppercase leading-normal text-gray-600">
                        <th className="px-6 py-3 text-left">Nombre</th>
                        <th className="px-6 py-3 text-left">Email</th>
                        <th className="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody className="text-sm font-light text-gray-600">
                    {users.data.map((user) => (
                        <tr
                            key={user.id}
                            className="border-b border-gray-200 hover:bg-gray-100"
                        >
                            <td className="px-6 py-3">{user.name}</td>
                            <td className="px-6 py-3">{user.email}</td>
                            <td className="flex space-x-2 px-6 py-3">
                                <InertiaLink
                                    href={`/users/${user.id}/edit`}
                                    className="rounded bg-yellow-500 px-3 py-1 text-white transition hover:bg-yellow-600"
                                >
                                    Editar
                                </InertiaLink>
                                <InertiaLink
                                    href={`/users/${user.id}`}
                                    method="delete"
                                    as="button"
                                    className="rounded bg-red-500 px-3 py-1 text-white transition hover:bg-red-600"
                                >
                                    Eliminar
                                </InertiaLink>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            {/* Paginación */}
            <div className="mt-4 flex justify-center">
                {users.links.map((link, index) => {
                    if (link.url) {
                        return (
                            <InertiaLink
                                key={index}
                                href={link.url}
                                className={`mx-1 rounded px-4 py-2 transition ${link.active ? 'bg-blue-500 text-white' : 'bg-gray-200 text-blue-500 hover:bg-blue-100'}`}
                            >
                                {link.label}
                            </InertiaLink>
                        );
                    }
                    return null;
                })}
            </div>
        </div>
    );
};

export default Index;
