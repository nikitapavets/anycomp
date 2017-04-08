import {css} from 'styled-components'

export const sizes = {
    mobile: 425,
    tablet: 768,
    laptop: 992,
    desktop: 1200,
    superHd: 8192
};

export const media = {
    tablet: (...args) => css`
        @media only screen and (min-width: ${sizes.mobile + 1}px) {
            ${ css(...args) }
        }
    `,
    laptop: (...args) => css`
        @media only screen and (min-width: ${sizes.tablet + 1}px) {
            ${ css(...args) }
        }
    `,
    desktop: (...args) => css`
        @media only screen and (min-width: ${sizes.laptop + 1}px) {
            ${ css(...args) }
        }
    `,
    wide: (...args) => css`
        @media only screen and (min-width: ${sizes.desktop + 1}px) {
            ${ css(...args) }
        }
    `
};

export const bgi = (img, size) => css`
    display: block; 
    background-image: url(${img});
    background-repeat: no-repeat;
    background-size: ${size}px;
    background-position: center;
    width: ${size}px;
    height: ${size}px;
`;
