import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';

import Breadcrumbs from '../Breadcrumbs';
import Form from '../Form/Form';
import FormBlock from '../Form/FormBlock';
import FormInput from '../Form/FormInput';

const RegistrationStyled = styled.div`
    background-color: ${colors.white};
    padding-bottom: 30px;
`;
const RegistrationStyled__Container = styled(Container)`
`;
const Header = styled.header`
    font-weight: 500;
    text-align: center;
    font-size: ${fontSizes.xl};
`;
const SubHeader = styled.div`
    text-align: center;
    font-size: ${fontSizes.s};
    opacity: .75;
    margin: 15px 0;
    line-height: 1.5em;
`;
const SubHeader__Link = styled(Link)`
    margin-left: 5px;
`;

export default class RegistrationPage extends React.Component {

    componentWillMount() {

        this.props.setBreadcrumbs([
            {
                title: 'Личный кабинет',
                link: '/user'
            },
            {
                title: 'Регистрация',
                link: '/user/registration'
            }
        ]);
    }

    render() {
        const error = this.props.users.error;

        return (
            <RegistrationStyled>
                <RegistrationStyled__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Header>Регистрация</Header>
                    <SubHeader>Если Вы уже зарегистрированы, перейдите на страницу
                        <SubHeader__Link to='/user'>авторизации</SubHeader__Link>.</SubHeader>
                    <Form handle={this.props.handleRegistrationUser} button='Готово'>
                        <FormBlock title='Основная информация'>
                            <FormInput title='Фамилия' name='client_second_name' error={error.client_second_name} required/>
                            <FormInput title='Имя' name='client_first_name' error={error.client_first_name} required/>
                            <FormInput title='Отчество' name='client_father_name' error={error.client_father_name}/>
                            <FormInput title='E-mail' name='client_email' type='email' error={error.client_email} required/>
                            <FormInput title='Телефон' name='client_mobile_phone' type='phone' error={error.client_mobile_phone} required/>
                        </FormBlock>
                        <FormBlock title='Ваш адрес'>
                            <FormInput title='Компания' name='client_organization_new' error={error.client_organization_new}/>
                            <FormInput title='Город' name='client_city_new' error={error.client_city_new}/>
                            <FormInput title='Улица' name='client_street' error={error.client_street}/>
                            <FormInput title='Дом' name='client_house' error={error.client_house}/>
                            <FormInput title='Квартира' name='client_flat' error={error.client_flat}/>
                        </FormBlock>
                        <FormBlock title='Ваш пароль'>
                            <FormInput title='Пароль' type='password' name='client_password' error={error.client_password} required/>
                            <FormInput title='Повторите пароль' type='password' name='client_password_confirmation' error={error.client_password_confirmed} required/>
                        </FormBlock>
                    </Form>
                </RegistrationStyled__Container>
            </RegistrationStyled>
        )
    }
}
